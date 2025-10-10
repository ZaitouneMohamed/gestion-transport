<?php

namespace App\Http\Controllers;

use App\Models\Papier;
use Illuminate\Http\Request;
use Carbon\Carbon; // Make sure to include Carbon at the
use Illuminate\Support\Facades\Cache;

class PapierController extends Controller
{
    public function index()
    {
        $data = Papier::with("Camion:id,matricule")
            ->select('id', 'camion_id', 'last_notification', 'days_count', 'title')
            ->latest()
            ->paginate(10);

        return view("gazole.camion.papiers.index", compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gazole.camion.papiers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'last_notification' => 'required|date',
            "date_fin" => "required|date|after:last_notification",
            'camion_id' => 'required|exists:camions,id',
            "description" => "nullable"
        ]);

        Papier::create($validatedData);
        Cache::forget('papier_count');

        return redirect()->route('papiers.index')->with('success', 'papier added with success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Papier  $papier
     * @return \Illuminate\Http\Response
     */
    public function show(Papier $papier)
    {
        return view('gazole.camion.papiers.show' , compact('papier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Papier  $papier
     * @return \Illuminate\Http\Response
     */
    public function edit(Papier $papier)
    {
        return view('gazole.camion.papiers.edit', compact('papier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Papier  $papier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Papier $papier)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'camion_id' => 'sometimes|required|exists:camions,id',
            "date_fin" => "required|date|after:last_notification",
            'last_notification' => 'required|date',
            'description' => 'sometimes',
        ]);
        $papier->update($validatedData);
        Cache::forget('papier_count');
        return redirect()->route('papiers.index')->with('success', 'papier update with success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Papier  $papier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Papier $papier)
    {
        $papier->delete();
        Cache::forget('papier_count');
        return redirect()->route('papiers.index')->with('success', 'papier deeted with success');
    }
}
