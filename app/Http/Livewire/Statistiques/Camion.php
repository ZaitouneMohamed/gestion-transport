<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Consomation;
use Livewire\Component;

class Camion extends Component
{
    public $camion , $datedebut , $datefin;
    public function render()
    {
        return view('livewire.statistiques.camion', [
            "trajets" => Consomation::where(function ($query) {
                $query->Where("camion_id",  $this->camion);
            })
                ->whereBetween('date', [$this->datedebut, $this->datefin])
                ->get()
        ]);
    }
}
