<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Consomation;
use Livewire\Component;

class Trajet extends Component
{
    public $ville, $datedebut, $datefin;
    function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
    public function render()
    {
        return view('livewire.statistiques.trajet', [
            "trajets" => Consomation::Where("ville",  $this->ville)
                ->whereBetween('date', [$this->datedebut, $this->datefin])
                ->with('Bons')
                ->get()
        ]);
    }
}
