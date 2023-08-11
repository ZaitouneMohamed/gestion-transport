<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsomationRequest;
use App\Http\Requests\UpdateConsomationRequest;
use App\Models\Consomation;
use Illuminate\Http\Request;

class ConsomationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consomations = Consomation::latest()->paginate(15);
        return view('gazole.consomation.index', compact('consomations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gazole.consomation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConsomationRequest $request)
    {
        $consomation = Consomation::create([
            "chaufeur_id" => $request->chaufeur_id,
            "camion_id" => $request->camion_id,
            "ville" => $request->ville,
            "description" => $request->description,
            "date" => $request->date,
        ]);
        return redirect()->route('consomations.index')->with([
            "success" => "consomation created sucssesfly"
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
        $consomation = Consomation::find($id);
        return view('gazole.consomation.edit', compact('consomation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConsomationRequest $request, $id)
    {
        $consomation = Consomation::find($id);
        $consomation->update([
            "chaufeur_id" => $request->chaufeur_id,
            "camion_id" => $request->camion_id,
            "ville" => $request->ville,
            "description" => $request->description,
            "date" => $request->date,
        ]);
        return redirect()->route('consomations.index')->with([
            "success" => "consomation updated sucssesfly"
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
        $conso = Consomation::find($id);
        $conso->delete();
        return redirect()->route('consomations.index')->with([
            "success" => "consomation deleted sucssesfly"
        ]);
    }
}
