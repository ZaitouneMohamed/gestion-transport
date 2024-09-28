<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Stations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::latest()->paginate(15);
        return view('gazole.station.index', compact('stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gazole.station.create');
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
            "name" => "required|unique:stations,name",
            "ville" => "required"
        ]);
        Station::create([
            "name" => $request->name,
            "ville" => $request->ville,
            "solde" => $request->solde,
            "gerant_name" => $request->gerant_name,
            "gerant_phone" => $request->gerant_phone,
            "gerant_rep_name" => $request->gerant_rep_name,
            "gerant_rep_phone" => $request->gerant_rep_phone,
        ]);
        Cache::forget('station_count');
        Cache::forget('station_count_index');
        return redirect()->route('stations.index')->with([
            "success" => "station added successfly"
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
        $station = Station::find($id);
        return view('gazole.station.edit', compact("station"));
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
        $station = Station::find($id);
        $this->validate($request, [
            "name" => "required",
            "ville" => "required"
        ]);
        $station->update([
            "name" => $request->name,
            "ville" => $request->ville,
            "solde" => $request->solde,
            "gerant_name" => $request->gerant_name,
            "gerant_phone" => $request->gerant_phone,
            "gerant_rep_name" => $request->gerant_rep_name,
            "gerant_rep_phone" => $request->gerant_rep_phone,
        ]);
        Cache::forget('station_count');
        Cache::forget('station_count_index');
        return redirect()->route('stations.index')->with([
            "success" => "station updated successfly"
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
        $station = Station::find($id);
        $station->delete();
        Cache::forget('station_count');
        Cache::forget('station_count_index');
        return redirect()->route('stations.index')->with([
            "success" => "station deleted successfly"
        ]);
    }
}
