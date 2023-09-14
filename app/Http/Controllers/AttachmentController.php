<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Http\Requests\StoreAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AttachmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:add_attachment', ['only' => ['store']]);
        $this->middleware('permission:view_attachment', ['only' => ['view']]);
        $this->middleware('permission:download_attachment', ['only' => ['download']]);
        $this->middleware('permission:delete_attachment', ['only' => ['delete']]);
        $this->middleware('permission:edit_attachment', ['only' => ['modify']]);
    }
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(StoreAttachmentRequest $request)
    {

        if ( $request->has('attachment') ) {

            $myfile = $request->file('attachment');
            $namefile = $myfile->getClientOriginalName();
            $extension = $myfile->extension();

            $attachment = Attachment::create([
                'name'  => $namefile ,
                'extension' =>  $extension,
                'document_id' => $request->document_id,
                'created_by' => userID(),
            ]);

            $request->file('attachment')->storeAs('/'.$request->document_name,$namefile,'docDisk');
        }

        Alert::success('! P.J ajoutée avec succès', 'La pièce jointe "'.$namefile.'" a été ajoutée au document avec succès ');
        return redirect()->back();
    }

    public function show($attchment_id)
    {


    }

    public function edit(Attachment $attachment)
    {
        //
    }

    public function update(UpdateAttachmentRequest $request, Attachment $attachment)
    {
        //
    }

    public function destroy(Attachment $attachment)
    {
        //
    }

    public function view(Request $request)
    {
        $document_name = $request->document_name;
        $file_name = $request->attachment_name;
        $pathfile = "/".$document_name."/".$file_name;

        $file_path = Storage::disk("docDisk")->path($pathfile);

        if (Storage::disk('docDisk')->exists($pathfile)) {
            return response()->file($file_path);
        }

        Alert::warning('! Document introuvable', 'La pièce jointe "'.$document_name.'" a été détruit et n\'est plus accessible');
        return redirect()->back();
    }

    public function download(Request $request)
    {
        $document_name = $request->document_name;
        $file_name = $request->attachment_name;
        $pathfile = "/".$document_name."/".$file_name;

        $file_path = Storage::disk("docDisk")->path($pathfile);

        if (Storage::disk('docDisk')->exists($pathfile)) {
            return response()->download($file_path, $file_name);
        }

        Alert::warning('! Document introuvable', 'La pièce jointe "'.$document_name.'" a été détruit et n\'est plus accessible');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $attachment = Attachment::findOrFail($request->attachment_id);
        $att_name = $attachment->name;

        $pathfile = "/".$request->document_name."/".$att_name;

        if (Storage::disk('docDisk')->exists($pathfile))
            Storage::disk("docDisk")->delete($pathfile);

        $attachment->delete();

        Alert::success('P.J supprimée avec succès !', 'La pièce jointe "'.$att_name.'" a été supprimée avec succès.');
        return redirect()->back();
    }
    public function modify(Request $request)
    {

        $validated = $request->validate([
            'attachment_name' => 'required|max:255',
            'description' => 'nullable|string',
        ], [
            'attachment_name.required' => 'Le champ nom de la pièce jointe est requis.',
            'attachment_name.unique' => 'Ce nom de pièce jointe est déjà utilisé.',
            'attachment_name.max' => 'Le nom de la pièce jointe ne doit pas dépasser :max caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ]);

        $att_id = $request->attachment_id;
        $att_name = $request->attachment_name;
        $doc_name = $request->document_name;
        $att_desc = $request->description;

        $attachment = Attachment::findOrFail($att_id);
        $pathfile = "/".$doc_name."/".$attachment->name;

        if (Storage::disk('docDisk')->exists($pathfile))
            Storage::disk("docDisk")->move($pathfile ,"/".$doc_name."/".$att_name);

        $attachment->update([
            "name" => $att_name,
            'description' => $att_desc,
            "updated_at" => now(),
        ]);

        Alert::success('P.J modifie avec succès !', 'La pièce jointe "'.$att_name.'" a été modifie avec succès.');
        return redirect()->back();
    }

}
