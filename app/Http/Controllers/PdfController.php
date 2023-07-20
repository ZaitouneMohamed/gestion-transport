<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfController extends Controller
{
    public function getsubcategories()
    {
        $categories = DB::table('orders')->select('category')->distinct()->get()->pluck('category')->toArray();
        $date = Order::first();
        $pdf = PDF::loadView('admin.pdf.bon_command', compact('categories','date'));
        return $pdf->stream('bon_command.pdf');
    }
    public function bon_reception()
    {
        $categories = DB::table('orders')->select('category')->distinct()->get()->pluck('category')->toArray();
        $date = Order::first();
        $pdf = PDF::loadView('admin.pdf.bon_reception', compact('categories','date'));
        return $pdf->stream('bon_reception.pdf');
    }
    
    public function recap()
    {
        $date = Order::first();
        $orders = Order::select('*')
                    ->get()
                    ->unique('order_number');
        $pdf = Pdf::loadView('admin.pdf.recap', compact('orders','date'));
        return $pdf->stream('recap.pdf');
    }
    public function tickets()
    {
        $date = Order::first();
        $orders = Order::select('*')
                    ->get()
                    ->unique('order_number');
        $pdf = Pdf::loadView('admin.pdf.tickets', compact('orders','date'));
        return $pdf->stream('recap.pdf');
    }
}
