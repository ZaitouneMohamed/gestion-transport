<?php

namespace App\Http\Controllers;

use App\Models\Reparation;
use App\Models\ReparationInfo;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function GetInfoOfReparation(Reparation $reparation)
    {
        $data = $reparation->load("Info");
        $pdf = PDF::loadView('gazole.pdf.ReparationInfo', compact('data'));
        return $pdf->stream('ReparationInfo.pdf');
    }
    public function GetAllReparationsInfo(Request $request)
    {
        $data = ReparationInfo::with('reparation')->whereBetween('date', [$request->date_debut, $request->date_fin])->get();

        $pdf = PDF::loadView('gazole.pdf.AllReparationInfo', compact('data'));
        return $pdf->stream('ReparationInfo.pdf');
    }
}
