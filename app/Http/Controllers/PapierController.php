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
        $today = Carbon::today();

        // Fetch papers with differences
        $data = Papier::with("Camion")
            ->select('id', 'camion_id', 'date_debut', 'date_fin',  'title') // Make sure to select relevant fields
            ->paginate(10);

        // Calculate the difference after pagination
        $data->getCollection()->transform(function ($papier) use ($today) {
            $papier->difference = $today->diffInDays($papier->date_fin, false);
            return $papier;
        });

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
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut', // Ensures date_fin is after or equal to date_debut
            'camion_id' => 'required|exists:camions,id', // Ensure camion_id exists in camions table
            "description" => "nullable"
        ]);

        $papier = Papier::create($validatedData);
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
            'date_debut' => 'sometimes|required|date',
            'date_fin' => 'sometimes|required|date|after_or_equal:date_debut', // Ensures date_fin is after or equal to date_debut
            'camion_id' => 'sometimes|required|exists:camions,id', // Ensure camion_id exists in camions table
        ]);
        Cache::forget('papier_count');
        $papier->update($validatedData);
        return redirect()->route('papiers.index')->with('success', 'papier added with success');
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
        return redirect()->route('papiers.index')->with('success', 'papier added with success');
    }
}
