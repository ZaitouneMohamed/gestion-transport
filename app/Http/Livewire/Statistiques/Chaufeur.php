<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Consomation;
use Livewire\Component;

class Chaufeur extends Component
{
    function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
    public $chaufeur, $datedebut, $datefin;
    public function render()
    {
        return view('livewire.statistiques.chaufeur', [
            "trajets" => Consomation::with(['Bons','Station','Camion','chaufeur'])->Where("chaufeur_id",  $this->chaufeur)
                ->whereBetween('date', [$this->datedebut, $this->datefin])
                ->get()
        ]);
    }
}
