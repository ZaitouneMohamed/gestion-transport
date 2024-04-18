<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Consomation;
use Livewire\Component;

class Trajet extends Component
{
    public $ville, $datedebut, $datefin,$camion;
    function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
    public function render()
    {
       return view('livewire.statistiques.trajet', [
            "trajets" => Consomation::where("ville", $this->ville)
                ->when($this->camion, function ($query, $camion) {
                    return $query->where('camion_id', $camion); 
                })
                ->whereBetween('date', [$this->datedebut, $this->datefin]) 
                ->with('Bons') 
                ->get() 
        ]);

    }
}
