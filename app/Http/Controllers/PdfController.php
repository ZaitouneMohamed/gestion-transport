<?php

namespace App\Http\Controllers;

use App\Models\Reparation;
use App\Models\ReparationInfo;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function GetInfoOfReparation($id)
    {
        $data = Reparation::find($id);
        $pdf = PDF::loadView('gazole.pdf.ReparationInfo', compact('data'));
        return $pdf->stream('ReparationInfo.pdf');
    }
    public function GetAllReparationsInfo(Request $request)
    {
        $data = ReparationInfo::with('reparation')->whereBetween('date', [$request->date_debut, $request->date_fin])->get();

        // Dump the data to inspect
        // dd($data);

        // Generate PDF with the reparations data
        $pdf = PDF::loadView('gazole.pdf.ReparationInfo', compact('data'));
        return $pdf->stream('ReparationInfo.pdf');
    }
}
