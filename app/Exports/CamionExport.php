<?php

namespace App\Exports;

use App\Models\Camion;
use App\Models\Consomation;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CamionExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $date_debut, $date_fin , $camion;
    public function __construct($date_debut, $date_fin , $camion)
    {
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->camion = $camion;
    }
    public function collection()
    {
        return Consomation::where('camion_id', $this->camion)
                    ->whereBetween('date', [$this->date_debut, $this->date_fin])
                    ->get()
                    ->map(function ($item) {
                        return [
                            "chaufeur" => $item->chaufeur->full_name,
                            "camion" => $item->camion->matricule,
                            "ville" => $item->ville,
                            "trajet_compose" => $item->QtyLittre,
                            "km_total" => $item->KmTotal,
                            "taux" => number_format($item->Taux, 2),
                            "camion_consomation" => $item->Camion->consommation,
                            "statue" => $item->Statue,
                            "prix" => $item->Prix,
                            "date" => $item->date,
                        ];
                    });
    }

    public function headings(): array
    {
        return [
            'Chauffeur',
            'Matricule Camion',
            'Ville',
            'Trajet Composé (Litres)',
            'Km Total',
            'Taux',
            'Consommation Camion',
            'Statut',
            'Prix',
            'Date',
        ];
    }
}
