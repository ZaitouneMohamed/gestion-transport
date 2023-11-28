<?php

namespace App\Exports;

use App\Models\Reparation;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReparationExport implements FromCollection
{
    protected $date_debut;
    protected $date_fin;

    public function __construct($date_debut , $date_fin)
    {
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Reparation::whereBetween('date', [$this->date_debut, $this->date_fin])
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
