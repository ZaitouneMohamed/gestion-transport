<?php

namespace App\Http\Controllers;

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
}
