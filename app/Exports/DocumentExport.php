<?php

namespace App\Exports;

use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocumentExport implements FromCollection
{
    public function collection()
    {

        // $docs = DB::table('documents')->select('id','name','description','section_id')->get();

        $docs = DB::table('documents')
            ->join('sections', 'documents.section_id', '=', 'sections.id')
            ->select(
                'documents.id',
                'documents.name',
                'documents.description',
                'sections.name AS section_name'
            )
            ->get();


        return $docs;
    }
}
