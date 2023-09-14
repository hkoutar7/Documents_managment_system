<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Document;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dasboardController extends Controller
{
    public function __invoke(Request $request)
    {

        $curMonth = Carbon::now()->month;
        $curYear = Carbon::now()->year;

        $month_client = DB::table('clients')
                    ->whereMonth('created_at', $curMonth)
                    ->whereYear('created_at',$curYear)
                    ->get()
                    ->count();

        $month_document = DB::table('documents')
                        ->whereMonth('created_at', $curMonth)
                        ->whereYear('created_at', $curYear)
                        ->whereNull('deleted_at')
                        ->get()
                        ->count();

        // Bar Graph
        $topSixSections = DB::table('documents')
            ->join('sections', 'documents.section_id', '=', 'sections.id')
            ->select('sections.id as section_id', 'sections.name as section_name', DB::raw('COUNT(*) as section_count'))
            ->groupBy('sections.id', 'sections.name')
            ->orderByDesc('section_count')
            ->take(3)
            ->get();

        $backgroundColor = [ 'rgba(255, 99, 132, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)'];

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($topSixSections->pluck('section_name')->toArray())
            ->datasets([
                [
                    "label" => "documents préfectoraux",
                    'data' => $topSixSections->pluck('section_count')->toArray(),
                    'backgroundColor' => $backgroundColor,
                ],
            ])
            ->options([
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                    ],
                ],
            ])
            ;

        // Circle graph
        $sum_section = Document::get()->count();

        $sumOtherSection = DB::table('documents')
                    ->whereNotIn('section_id', [$topSixSections[0]->section_id, $topSixSections[1]->section_id, $topSixSections[2]->section_id])
                    ->get()->count();

        $firstSectionPerc = ($topSixSections[0]->section_count / $sum_section) * 100;
        $SecondSectionPerc = ($topSixSections[1]->section_count / $sum_section) * 100;
        $ThirdSectionPerc = ($topSixSections[2]->section_count / $sum_section) * 100;
        $otherSectionPerc = ($sumOtherSection / $sum_section) * 100;


        $circleStat = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels([$topSixSections[0]->section_name, $topSixSections[1]->section_name, $topSixSections[2]->section_name, 'autre sections'])
            ->datasets([
                [
                    'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192, 0.2)',],
                    'hoverBackgroundColor' => ['rgb(255, 99, 132)', 'rgb(255, 159, 64)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)',],
                    'data' => [$firstSectionPerc, $SecondSectionPerc,$ThirdSectionPerc,$otherSectionPerc ]
                ]
            ])
            ->options([
            ]);

        // Recent Customer :
        $recentClients = DB::table('clients')->orderBy('created_at','desc')->limit(3)->get();

        return view('dashboard.index', compact('month_client', 'month_document', "chartjs",'circleStat','recentClients'));
    }
}
