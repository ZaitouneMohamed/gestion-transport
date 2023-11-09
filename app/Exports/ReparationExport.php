<?php

namespace App\Exports;

use App\Models\Reparation;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReparationExport implements FromCollection
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Reparation::whereDate('date', $this->date)
            ->get()
            ->map(function ($item) {
                return [
                    "date" => $item->date,
                    "chaufeur_name" => $item->Chaufeur->full_name,
                    "chaufeur_code" => $item->Chaufeur->code,
                    "chaufeur_matricule" => $item->Camion->matricule,
                    "reparation" => $item->reparation,
                    "prix" => $item->prix,
                    "nature" => $item->nature,
                    "fournisseur" => $item->fournisseur,
                ];
            });
    }
}
