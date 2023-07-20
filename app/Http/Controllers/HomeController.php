<?php

namespace App\Http\Controllers;

use App\Imports\OrderImport;
use App\Models\Bons;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
{
    public function upload(Request $request)
    {
        request()->validate([
            'orders' => 'required|mimes:xlx,xlsx|max:2048'
        ]);
        Excel::import(new OrderImport, $request->file('orders'));
        return back()->with('massage', 'User Imported Successfully');
    }
    public function clear()
    {
        DB::table('orders')->delete();
        return redirect()->back()->with([
            "success" => "table cleared successfly"
        ]);
    }

    function GazoleUsersList()
    {
        $users = User::role('gazole')->get();
        return view('gazole.user.index', compact('users'));
    }

    function CreateBon($id)
    {
        return view('gazole.bon.create', compact("id"));
    }
    public function AddBonToConsomation(Request $request, $id)
    {
        $this->validate($request, [
            "date" => "required",
            "qte_litre"=>"required",
            "station_id"=>"required",
            "ville"=>"required",
            "date"=>"required",
            "numero_bon"=>"required",
            "km_return"=>"required",
            "nature"=>"required"
        ]);
        $bons = Bons::create([
            "consomation_id"=>$id,
            "qte_litre"=>$request->qte_litre,
            "station_id"=>$request->station_id,
            "ville"=>strtoupper($request->ville),
            "date"=>$request->date,
            "numero_bon"=>$request->numero_bon,
            "km_return"=>$request->km_return,
            "nature"=>$request->nature,
        ]);
        return redirect()->route('consomations.index')->with([
            "success"=>"bon added successfly"
        ]);
    }
}
