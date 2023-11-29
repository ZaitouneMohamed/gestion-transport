<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Reparation;
use Livewire\Component;

class ReparationStatistiques extends Component
{
    public $datedebut, $datefin;
    public function render()
    {
        return view('livewire.statistiques.reparation-statistiques',[
            "reparations" => Reparation::whereBetween('date', [$this->datedebut, $this->datefin])
                ->with(['chaufeur','Camion'])
                ->get()
        ]);
    }
    public function mount() {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
}
