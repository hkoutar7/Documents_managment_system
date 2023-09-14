<?php

namespace App\Http\Controllers;

use App\Exports\DocumentExport;
use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Attachment;
use App\Models\Client;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Comment\Doc;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
// Use Alert;

class DocumentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list_documents', ['only' => ['index']]);
        $this->middleware('permission:add_document', ['only' => ['create','store']]);
        $this->middleware('permission:edit_document', ['only' => ['edit','update']]);
        $this->middleware('permission:view_document', ['only' => ['show']]);
        $this->middleware('permission:export_document_excel', ['only' => ['export']]);
        $this->middleware('permission:archive_document', ['only' => ['softDelete']]);
        $this->middleware('permission:delete_document', ['only' => ['forceDelete']]);
    }

    public function index() : View
    {
        $documents = Document::all();

        return view('documents.index',compact('documents'));
    }

    public function create() : View
    {
        $sections = Section::get();
        $clients = Client::get();
        return view('documents.create',compact('sections','clients'));
    }

    public function store(StoreDocumentRequest $request)
    {
        $client = Client::findOrFail($request->client);

        $document = Document::create([
            'client_id' => $client->id,
            'name' => $request->name,
            'description' => $request->description,
            'section_id' => $request->section,
            'created_by' => userID(),
        ]);

        $documentId = DB::table('documents')->latest()->first()->id;


        if ( $request->has('attachment') ) {

            $myfile = $request->file('attachment');
            $namefile = $myfile->getClientOriginalName();
            $extension = $myfile->extension();

            $attachment = Attachment::create([
                'name'  => $namefile ,
                'extension' =>  $extension,
                'description'  => 'no desc',
                'document_id' => $documentId,
                'created_by' => userID(),
            ]);

            $request->file('attachment')->storeAs('/'.$request->name,$namefile,'docDisk');
        }

        Alert::success('! Document Créé avec Succès', 'Le document "'.$request->name.'" a été créé et ajouté à notre collection numérique');
        return redirect()->route('documents.index');
    }

    public function show($id) : View
    {
        $document = Document::findOrFail($id);

        return view('documents.show',compact('document'));
    }

    public function edit($id) : View
    {
        $sections = Section::get();
        $clients = Client::get();
        $document = Document::where('id','=',$id)->first();

        return view('documents.edit',compact('document','sections','clients'));
    }

    public function update(UpdateDocumentRequest $request) : RedirectResponse
    {
        $document = Document::find($request->id_doc);

        $document->name = $request['name'];
        $document->section_id = $request['section'];
        $document->client_id = $request['client'];
        $document->description = $request['description'];
        $document->updated_at = now();
        $document->save();

        Alert::success('! Document Mis à Jour avec Succès', 'Le document "'.$request->name.'" a été actualisé dans notre collection numérique');

        return redirect()->route('documents.index');
    }

    public function destroy(Request $request)
    {

    }

    public function export()
    {
        return Excel::download(new DocumentExport, 'les_document.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function softDelete(Request $request) : RedirectResponse
    {

        $document = Document::findOrFail($request->id_doc);
        $document->delete();

        Alert::success('! Document aux archives', 'Le document intitulé "'.$request->name_doc.'"a été soigneusement rangé dans nos archives numériques');

        return redirect()->back();
    }

    public function forceDelete(Request $request) : RedirectResponse
    {

        $document = Document::findOrFail($request->id_doc);
        $document->forceDelete();

        $attachments = Attachment::where('document_id',  $request->id_doc)->get();

        foreach ($attachments as $att)
            $att->delete();

        if (Storage::disk('docDisk')->exists("/".$request['name_doc']))
            Storage::disk('docDisk')->deleteDirectory("/".$request['name_doc']);

        Alert::success('! Document Supprimé', 'Le document intitulé "'.$request->name_doc.'"a été effacé avec succès de nos dossiers');

        return redirect()->back();
    }

}
