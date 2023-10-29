<?php

namespace App\Http\Controllers;

use App\Exports\FactureExport;
use App\Exports\FactureGeneraleExport;
use App\Exports\MissionExport;
use App\Exports\TrajetExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function exportTrajet(Request $request)
    {
        $date = Carbon::parse($request->input('date'));

        return Excel::download(new TrajetExport($date), 'trajet_export.xlsx');
    }
    public function exportMission(Request $request)
    {
        $date = Carbon::parse($request->input('date'));
        return Excel::download(new MissionExport($date ), 'Mission_export.xlsx');
    }
    public function exportFacture(Request $request)
    {
        $date_debut = Carbon::parse($request->input('datedebut'));
        $date_fin = Carbon::parse($request->input('datefin'));
        $station = $request->input('station');
        return Excel::download(new FactureExport($date_debut ,$date_fin, $station), 'Facture_export.xlsx');
    }
    public function exportFactureTotalGenerale(Request $request)
    {
        $date_debut = Carbon::parse($request->input('datedebut'));
        $date_fin = Carbon::parse($request->input('datefin'));
        return Excel::download(new FactureGeneraleExport($date_debut ,$date_fin), 'Facture_total_general_export.xlsx');
    }
}
