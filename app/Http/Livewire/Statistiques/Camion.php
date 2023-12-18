<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Consomation;
use Livewire\Component;

class Camion extends Component
{
    function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
    public $camion , $datedebut , $datefin;
    public function render()
    {
        return view('livewire.statistiques.camion', [
            "trajets" => Consomation::where(function ($query) {
                $query->Where("camion_id",  $this->camion);
            })
                ->where("status", 1)
                ->whereBetween('date', [$this->datedebut, $this->datefin])
                ->get()
        ]);
    }
}
