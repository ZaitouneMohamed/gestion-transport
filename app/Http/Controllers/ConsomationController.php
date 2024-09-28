<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsomationRequest;
use App\Http\Requests\UpdateConsomationRequest;
use App\Models\Consomation;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ConsomationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Consomation::orderBy('date', 'desc');

        if ($request->has('date')) {
            $date = $request->input('date');
            $query->where('date', $date);
        }

        $consomations = $query->paginate(15);

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
        // dd($request->all());
        $ville = Ville::find($request->ville);
        Consomation::create([
            "chaufeur_id" => $request->chaufeur_id,
            "camion_id" => $request->camion_id,
            "ville" => $ville->name,
            "description" => $request->description,
            "date" => $request->date,
            "km_proposer" => $ville->km_proposer,
            "n_magasin" => $request->nombre_magasin,
            "statue" => 0
        ]);
        Cache::forget('consomation_count');
        Cache::forget('consomationsCountIndex');
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
            "n_magasin" => $request->nombre_magasin,
            "ville" => $request->ville,
            "description" => $request->description,
            "date" => $request->date,
        ]);
        Cache::forget('consomation_count');
        Cache::forget('consomationsCountIndex');
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
        Cache::forget('consomation_count');
        Cache::forget('consomationsCountIndex');
        return redirect()->route('consomations.index')->with([
            "success" => "consomation deleted sucssesfly"
        ]);
    }
}
