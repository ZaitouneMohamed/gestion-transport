<?php

namespace App\Exports;

use App\Models\Reparation;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReparationExport implements FromCollection, WithHeadings
{
    protected $date_debut;
    protected $date_fin;

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
        return Reparation::whereBetween('date', [$this->date_debut, $this->date_fin])
            ->with('Info')
            ->get()
            ->flatMap(function ($reparation) {
                return $reparation->Info->map(function ($info) use ($reparation) {
                    return [
                        "date" => $reparation->date,
                        "n_bon" => $reparation->n_bon,
                        "prix_1" => $reparation->prix,
                        // relation here
                        'camion' => $info->camion?->matricule,
                        'chaufeur' => $info->chaufeur?->full_name,
                        'prix_2'=>$info->prix,
                        'date_2'=>$info->date,
                        'nature'=>$info->nature,
                        'type_id'=>$info->type?->name,
                    ];
                });
            });
    }

    public function headings(): array
    {
        return [
            'Date Reparation',
            'Numéro de Bon',
            'Prix Reparation',
            'Matricule Camion',
            'Nom Chauffeur',
            'Prix Info',
            'Date Info',
            'Nature Info',
            'Type Info',
        ];
    }
}
