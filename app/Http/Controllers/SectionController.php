<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SectionController extends Controller
{
    public function __construct() {
        $this->middleware('permission:section_list', ['only' => ['index']]);
        $this->middleware('permission:section_create', ['only' => ['store']]);
        $this->middleware('permission:section_edit', ['only' => ['update']]);
        $this->middleware('permission:section_delete', ['only' => ['destroy']]);
    }
    public function index() : View
    {
        $sections = Section::all();

        $section_num = Section::get()->count();

        return view("sections.index", compact("sections","section_num"));
    }

    public function create()
    {
    }

    public function store(StoreSectionRequest $request)
    {

        Section::create([
            "name" => $request->section_name,
            "description" => $request->description,
            "created_by" => userID(),
        ]);

        Alert::success('! Section Créé avec Succès', 'La section "'.$request->section_name.'" a été créé et ajouté à nos sections');
        return redirect()->back();
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(UpdateSectionRequest $request)
    {
        Section::findOrFail($request->id)->update([
            "name" => $request->section_name,
            "description" => $request->description,
            'updated_at' => now(),
        ]);

        Alert::success('Section modifiée avec succès', 'La section "'.$request->section_name.'" a été mise à jour dans nos sections');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $section = Section::find($request->id);
        $section->delete();

        Alert::success('Section supprimée avec succès', 'La section "'.$request->section_name.'" a été retirée de nos sections');
        return redirect()->back();
    }

}
