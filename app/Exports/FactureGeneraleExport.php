<?php

namespace App\Exports;

use App\Models\facture;
use App\Models\Station;
use Maatwebsite\Excel\Concerns\FromCollection;

class FactureGeneraleExport implements FromCollection
{
    protected $date_debut, $date_fin;
    public function __construct($date_debut, $date_fin)
    {
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $station_id = Station::where('name', 'DIVERS')->first();
        return facture::whereBetween('date', [$this->date_debut, $this->date_fin])
            ->where('station_id', '!=', $station_id->id)
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
            });;
    }
}
