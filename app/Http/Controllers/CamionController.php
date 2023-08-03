<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\Chaufeur;
use Illuminate\Http\Request;

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
        ]);
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
        ]);
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
        return redirect()->route('camions.index')->with([
            "success" => "camion deleted successly"
        ]);
    }
}
