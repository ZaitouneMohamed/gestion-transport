<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Consomation;
use Livewire\Component;

class Chaufeur extends Component
{
    public $chaufeur, $datedebut, $datefin;
    public function render()
    {
        return view('livewire.statistiques.chaufeur', [
            "trajets" => Consomation::where(function ($query) {
                $query->Where("chaufeur_id",  $this->chaufeur);
            })
                ->whereBetween('date', [$this->datedebut, $this->datefin])
                ->get()
        ]);
    }
}
