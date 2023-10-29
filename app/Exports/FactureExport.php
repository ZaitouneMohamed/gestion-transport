<?php

namespace App\Exports;

use App\Models\facture;
use Maatwebsite\Excel\Concerns\FromCollection;

class FactureExport implements FromCollection
{
    protected $date_debut, $date_fin, $station;

    public function __construct($date_debut , $date_fin, $station)
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
            ->where('station_id',$this->station)
            ->get()
            ->map(function ($facture) {
                return [
                    "date" => $facture->date,
                    "prix" => $facture->prix,
                    "station" => $facture->Station->name,
                    "n_bon" => $facture->n_bon,
                ];
            });
        ;
    }
}
