<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\CamionCharge;
use App\Models\Chaufeur;
use App\Models\Natures;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CamionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $camions = Camion::latest()->paginate(10);
        return view('gazole.camion.index', compact('camions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gazole.camion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "matricule" => "required|unique:camions,matricule",
            "consommation" => "required",
        ]);
        Camion::create([
            "matricule" => $request->matricule,
            "consommation" => $request->consommation,
            "marque" => $request->marque,
            "genre" => $request->genre,
            "type_carburant" => $request->type_carburant,
            "n_chasie" => $request->n_chasie,
            "puissanse_fiscale" => $request->pupuissanse_fiscale,
            "premier_mise" => $request->premier_mise,
        ]);
        Cache::forget('camion_count');
        Cache::forget('camion_aej_count');
        return redirect()->route('camions.index')->with([
            "success" => "camion added successly"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentMonth = Carbon::now()->month;
        $camion = Camion::with(['Charge','Papiers', 'Consomations' => function ($query) use ($currentMonth) {
            $query->whereMonth('date', $currentMonth);
        }])->find($id);
        $chaufeurs = Chaufeur::active()->get();
        $natures = Natures::all();
        return view('gazole.camionCharge.index', compact('camion', 'chaufeurs', 'natures'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $camion = Camion::find($id);
        return view('gazole.camion.edit', compact('camion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $camion = Camion::find($id);
        $this->validate($request, [
            "matricule" => "required",
            "consommation" => "required",
        ]);
        $camion->Update([
            "matricule" => $request->matricule,
            "consommation" => $request->consommation,
            "marque" => $request->marque,
            "genre" => $request->genre,
            "type_carburant" => $request->type_carburant,
            "n_chasie" => $request->n_chasie,
            "puissanse_fiscale" => $request->pupuissanse_fiscale,
            "premier_mise" => $request->premier_mise,
        ]);
        Cache::forget('camion_count');
        Cache::forget('camion_aej_count');
        return redirect()->route('camions.index')->with([
            "success" => "camion added successly"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Camion::find($id)->delete();
        Cache::forget('camion_count');
        Cache::forget('camion_aej_count');
        return redirect()->route('camions.index')->with([
            "success" => "camion deleted successly"
        ]);
    }
    public function AddNewCharge(Request $request)
    {
        $this->validate($request, [
            "chaufeur_id" => "required|exists:chaufeurs,id",
            "date" => "required",
        ]);
        CamionCharge::create([
            "camion_id" => $request->camion_id,
            "chaufeur_id" => $request->chaufeur_id,
            "date" => $request->date,
            "nature" => $request->nature,
            "prix_location" => $request->prix_location,
        ]);
        return redirect()->back()->with([
            "success" => "charge create with success"
        ]);
    }
    public function deleteCharge(CamionCharge $camionCharge)
    {
        $camionCharge->delete();
        return redirect()->back()->with([
            "success" => "charge deleted with success"
        ]);
    }
}
