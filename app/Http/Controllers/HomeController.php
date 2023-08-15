<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBonRequest;
use App\Imports\OrderImport;
use App\Models\Bons;
use App\Models\Consomation;
use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


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
    public function AddBonToConsomation(StoreBonRequest $request, $id)
    {
        $ville = Station::find($request->station_id)->ville;
        $tarif = $request->tarif;
        $qte_litre = $request->qte_litre;
        $km = $request->km_return;
        if ($km <= 0 || $qte_litre <= 0) {
            $qte_litre = 1;
            $km = 1;
        }
        $prix = $tarif * $qte_litre;
        $bons = Bons::create([
            "consomation_id" => $id,
            "qte_litre" => $request->qte_litre,
            "prix" => $prix,
            "station_id" => $request->station_id,
            "ville" => $ville,
            "date" => $request->date,
            "numero_bon" => $request->numero_bon,
            "km" => $km,
            "nature" => $request->nature,
            "description" => $request->description,
        ]);
        return redirect()->route('consomations.index')->with([
            "success" => "bon added successfly"
        ]);
    }

    public function getStations(Request $request)
    {
        $city = $request->city;
        $stations = Station::where('ville', $city)->get();
        return response()->json($stations);
    }

    public function ViewBonsOfTrajet($id)
    {
        $trajet = Consomation::find($id);
        return view('gazole.bon.index', compact("trajet"));
    }

    public function UpdateBon($id, Request $request)
    {
        $bon = Bons::findOrFail($id);
        $bon->update([
            "qte_litre" => $request->qte,
            "prix" => $request->prix,
            "km" => $request->km
        ]);
        return redirect()->back()->with([
            "success" => "bon updated successfully;"
        ]);
    }
    public function DeleteBon($id)
    {
        $bon = Bons::findOrFail($id);
        if ($bon != null) {
            $bon->delete();
            return redirect()->back()->with([
                "success" => "bon deleted successfully;"
            ]);
        };
    }
}
