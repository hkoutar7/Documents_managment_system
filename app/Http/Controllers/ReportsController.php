<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportsRequest;
use App\Models\Document;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct() {
        $this->middleware('permission:reports', ['only' => ['index']]);
        $this->middleware('permission:filter_documents', ['only' => ['filter']]);
        $this->middleware('permission:search_documents', ['only' => ['search']]);
    }

    public function index ()  : View
    {

        $sections = Section::get();
        $documents = Document::all();

        return view('reports.index', compact('sections','documents'));
    }

    public function filter(Request $request)
    {
        $validated = $request->validate([
            "section" => 'required',
            "doc_from" => 'bail|nullable|date',
            "doc_to" => 'bail|nullable|date|after:doc_from',
        ],[
            "section.required" => "Le champ section est requis.",
            "doc_from.date" => "Le champ date de début doit être une date valide.",
            "doc_to.date" => "Le champ date de fin doit être une date valide.",
            "doc_to.after" => "La date de fin doit être ultérieure à la date de début.",
        ]);

        $sectionId = $request['section'];
        $startDate = $request->doc_from !== null ? Carbon::parse($request->doc_from) : null;
        $endDate = $request->doc_to !== null ? Carbon::parse($request->doc_to) : null;


        $query = Document::where('section_id', $sectionId);

        if ($startDate !== null) {
            if ($endDate !== null) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            } else {
                $query->where('created_at', '>=', $startDate);
            }
        } elseif ($endDate !== null) {
            $query->where('created_at', '<=', $endDate);
        }

        $documents = $query->get();
        $sections = Section::get();
        return view('reports.index', compact('sections','documents'));
    }

    public function search(Request $request)
    {
        // $documents = Document::where('name', 'like', '%' . $request->search_string . '%')->get();

        // if ($documents->isEmpty()) {
        //     $message = 'No documents found matching your search.';
        //     return response()->view('reports.index', compact('message'))->header('Content-Type', 'text/html');
        // }

        // return response()->view('reports.index', compact('documents'))->header('Content-Type', 'text/html');
    }


}
