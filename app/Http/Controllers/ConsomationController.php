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
        $query = Consomation::with([
            'chaufeur:id,full_name', // Select only needed fields
            'camion:id,matricule,consommation',
            'station:id,name',
            'bons' => function ($query) {
                $query->where('nature', 'gazole')
                      ->select('id', 'consomation_id', 'km', 'qte_litre', 'prix', 'nature')
                      ->orderBy('id');
            }
        ])->orderBy('date', 'desc');

        if ($request->has('date')) {
            $date = $request->input('date');
            $query->where('date', $date);
        }

        $consomations = $query->paginate(15);

        // Pre-calculate computed values to avoid N+1 in view
        $consomations->getCollection()->transform(function ($consomation) {
            $consomation->calculated_values = $this->calculateTrajetValues($consomation);
            return $consomation;
        });

        return view('gazole.consomation.index', compact('consomations'));
    }

    /**
     * Calculate all trajet values in one method to avoid multiple queries
     */
    private function calculateTrajetValues(Consomation $consomation): array
    {
        $gazoleBons = $consomation->bons->where('nature', 'gazole')->sortBy('id');

        if ($gazoleBons->count() < 2) {
            return [
                'qty_littre' => null,
                'km_total' => null,
                'taux' => null,
                'prix' => 0,
                'statue' => null,
            ];
        }

        $firstBon = $gazoleBons->first();
        $lastBon = $gazoleBons->last();

        if (!$firstBon->km || !$lastBon->km) {
            return [
                'qty_littre' => null,
                'km_total' => null,
                'taux' => null,
                'prix' => 0,
                'statue' => null,
            ];
        }

        // Calculate values
        $qtyLittre = $gazoleBons->sum('qte_litre') - $firstBon->qte_litre;
        $kmTotal = $lastBon->km - $firstBon->km;
        $prix = $gazoleBons->sum('prix') - $firstBon->prix;
        $taux = $kmTotal > 0 ? ($qtyLittre / $kmTotal * 100) : null;

        // Calculate statue - match original logic exactly
        $statue = null;
        if ($taux !== null && $consomation->camion->consommation) {
            $statue = $taux - $consomation->camion->consommation;
        }

        return [
            'qty_littre' => $qtyLittre,
            'km_total' => $kmTotal,
            'taux' => $taux,
            'prix' => $prix,
            'statue' => $statue,
        ];
    }

    public function create()
    {
        return view('gazole.consomation.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConsomationRequest $request)
    {
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

        // Clear cache
        $this->clearConsomationCache();

        return redirect()->route('consomations.index')
            ->with('success', 'Consomation created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consomation = Consomation::findOrFail($id);
        return view('gazole.consomation.edit', compact('consomation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConsomationRequest $request, $id)
    {
        $consomation = Consomation::findOrFail($id);

        $consomation->update([
            "chaufeur_id" => $request->chaufeur_id,
            "camion_id" => $request->camion_id,
            "n_magasin" => $request->nombre_magasin,
            "ville" => $request->ville,
            "description" => $request->description,
            "date" => $request->date,
        ]);

        $this->clearConsomationCache();

        return redirect()->route('consomations.index')
            ->with('success', 'Consomation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consomation = Consomation::findOrFail($id);
        $consomation->delete();

        $this->clearConsomationCache();

        return redirect()->route('consomations.index')
            ->with('success', 'Consomation deleted successfully');
    }

    /**
     * Clear related cache keys
     */
    private function clearConsomationCache(): void
    {
        Cache::forget('consomation_count');
        Cache::forget('consomationsCountIndex');
    }
}
