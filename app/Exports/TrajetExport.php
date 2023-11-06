<?php

namespace App\Exports;

use App\Models\Consomation;
use Maatwebsite\Excel\Concerns\FromCollection;

class TrajetExport implements FromCollection
{
    private $trajets;

    public function __construct($trajets)
    {
        $this->trajets = $trajets;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = [];
        foreach ($this->trajets as $trajet) {
            foreach ($trajet->Bons as $bon) {
                $data[] = [
                    'chaufeur' => $trajet->chaufeur->full_name,
                    'camion' => $trajet->Camion->matricule,
                    'ville' => $trajet->ville,
                    'date' => $trajet->date,
                    'trajet_comose' => $trajet->QtyLittre,
                    'km_total' => $trajet->KmTotal,
                    'camion_consomation' => $trajet->Camion->consommation,
                    'statue' => $trajet->statue,
                    'prix' => $trajet->Prix,
                    'bon_number' => $bon->numero_bon,
                    'bon_date' => $bon->date,
                    'qte_littre' => $bon->qte_litre,
                    'bon_prix' => $bon->prix,
                    'bon_km' => $bon->km,
                    'station' => $bon->station->name,
                    'nature' => $bon->nature,
                ];
            }
        }
        return collect($data);
    }
    public function headings(): array
    {
        return [
            'chaufeur',
            'camion',
            'ville',
            'date',
            'trajetcompose',
            'km_total',
            'camion consomation',
            'statue',
            'prix',
            'numero_bon',
            'bon_date',
            'Qte_littre',
            'bon_prix',
            'bon_km',
            'station',
            'nature',
        ];
    }
}
