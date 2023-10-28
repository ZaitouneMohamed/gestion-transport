<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missions = Mission::latest()->paginate(15);
        return view('gazole.mission.index', compact("missions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gazole.mission.create');
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
            "chaufeur_id" => "required",
            "camion_id" => "required",
            "ville_id" => "required",
            "date" => "required",
            "km_total" => "required",
            "nombre_magasin" => "required",
        ]);
        Mission::create([
            "chaufeur_id" => $request->chaufeur_id,
            "camion_id" => $request->camion_id,
            "ville_id" => $request->ville_id,
            "date" => $request->date,
            "km_total" => $request->km_total,
            "nombre_magasin" => $request->nombre_magasin,
        ]);
        return redirect()->route('missions.index')->with([
            "success" => "Mission ajoutée avec succès"
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mission = Mission::findOrFail($id);
        return view('gazole.mission.edit', compact("mission"));
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
        $this->validate($request, [
            "chaufeur_id" => "required",
            "camion_id" => "required",
            "ville_id" => "required",
            "date" => "required",
            "km_total" => "required",
            "nombre_magasin" => "required",
        ]);
        $mission = Mission::findOrFail($id);
        $mission->update([
            "chaufeur_id" => $request->chaufeur_id,
            "camion_id" => $request->camion_id,
            "ville_id" => $request->ville_id,
            "date" => $request->date,
            "km_total" => $request->km_total,
            "nombre_magasin" => $request->nombre_magasin,
        ]);
        return redirect()->route('missions.index')->with([
            "success" => "Mission modifiée avec succès"
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
        $mission = Mission::findOrFail($id);
        $mission->delete();
        return redirect()->route('missions.index')->with([
            "success" => "Mission supprimée avec succès"
        ]);
    }
}
