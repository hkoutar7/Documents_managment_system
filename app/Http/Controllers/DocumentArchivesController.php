<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Document;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DocumentArchivesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:archives', ['only' => ['index']]);
        $this->middleware('permission:restore_from_archive', ['only' => ['restore']]);
        $this->middleware('permission:delete_from_archive', ['only' => ['delete']]);
    }
    public function index () : View
    {
        $documents = Document::onlyTrashed()->get();

        return view('documents.archive', compact('documents'));
    }

    public function restore(Request $request)
    {

        Document::onlyTrashed()
                ->where('id', $request->id_doc)
                ->restore();

        Alert::success('Document restauré avec succès !', 'Le document "'.$request['name_doc'].'" a été restaurée avec succès depuis les archives');
        return  redirect()->route('documents.show',$request->id_doc);
    }

    public function delete(Request $request)
    {
        Document::onlyTrashed()
                ->where('id', $request->id_doc)
                ->forceDelete();

        $attachments = Attachment::where('document_id',  $request->id_doc)->get();

        foreach ($attachments as $att)
            $att->delete();

        if (Storage::disk('docDisk')->exists("/".$request['name_doc']))
            Storage::disk('docDisk')->deleteDirectory("/".$request['name_doc']);

        Alert::success('Document supprimé avec succès !', 'Le document "'.$request['name_doc'].'" a été supprimé avec succès depuis les archives');
        return  redirect()->back();
    }

}
