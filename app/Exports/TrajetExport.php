<?php

namespace App\Exports;

use App\Models\Consomation;
use Maatwebsite\Excel\Concerns\FromCollection;

class TrajetExport implements FromCollection
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
        return Consomation::whereDate('date', $this->date)
            ->with(['chaufeur', "Camion"])
            ->get()
            ->map(function ($trajet) {
                return [
                    'full_name' => $trajet->chaufeur->full_name,
                    'matricule' => $trajet->camion->matricule,
                    'ville' => $trajet->ville,
                    'trajet_compose' => $trajet->QtyLittre,
                    'km_total' => $trajet->KmTotal,
                    'taux' => number_format($trajet->Taux, 2),
                    'camion_consomation' => $trajet->camion->consommation,
                    'statue' => $trajet->statue,
                    'prix' => $trajet->Prix,
                    'date' => $trajet->date,
                ];
            });
    }
    public function headings(): array
    {
        return [
            'full_name',
            'matricule',
            'ville',
            'trajet_compose',
            'km_total',
            'taux',
            'camion_consomation',
            'statue',
            'prix',
            'date',
        ];
    }
}
