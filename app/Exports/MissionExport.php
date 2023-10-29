<?php

namespace App\Exports;

use App\Models\Mission;
use Maatwebsite\Excel\Concerns\FromCollection;

class MissionExport implements FromCollection
{
    protected $date, $ville;

    public function __construct($date, $ville)
    {
        $this->date = $date;
        $this->ville = $ville;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Mission::whereDate('date', $this->date)
            ->where('ville_id', $this->ville)
            ->get()
            ->map(function ($mission) {
                return [
                    "date" => $mission->date,
                    "chaufeur_name" => $mission->chaufeur->full_name,
                    "chaufeur_code" => $mission->chaufeur->code,
                    "ville" => $mission->Ville->name,
                    "nombre_magasin" => $mission->nombre_magasin,
                    "camion_matricule" => $mission->Camion->matricule,
                    "km_proposer" => $mission->Ville->km_proposer,
                    "km_total" => $mission->km_total,
                    "statue" => $mission->km_total - $mission->Ville->km_proposer,
                ];
            });
    }
}
