<?php

namespace App\Exports;

use App\Models\facture;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FactureExport implements FromCollection, WithHeadings
{
    protected $date_debut, $date_fin, $station;

    public function __construct($date_debut, $date_fin, $station)
    {
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->station = $station;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return facture::whereBetween('date', [$this->date_debut, $this->date_fin])
            ->where('station_id', $this->station)
            ->get()
            ->map(function ($facture) {
                $type_word = '';
                if ($facture->type == 0) {
                    $type_word = 'facture';
                } elseif ($facture->type == 1) {
                    $type_word = 'espéce';
                } else {
                    $type_word = 'caisse';
                }
                return [
                    "date" => $facture->date,
                    "prix" => $facture->prix,
                    "station" => $facture->Station->name,
                    "n_bon" => $facture->n_bon,
                    "type" => $type_word,
                ];
            });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Date',
            'Prix',
            'Station',
            'Numéro de Bon',
            'Type',
        ];
    }
}
