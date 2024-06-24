<?php

namespace App\Exports;

use App\Models\Consomation;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TrajetExport implements FromCollection, WithHeadings
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
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Chauffeur',
            'Matricule Camion',
            'Ville',
            'Date',
            'Trajet Composé (Litres)',
            'KM Total',
            'Consommation Camion',
            'Statut',
            'Prix',
            'Numéro de Bon',
            'Date du Bon',
            'Quantité de Litres',
            'Prix du Bon',
            'KM du Bon',
            'Station',
            'Nature du Bon',
        ];
    }
}
