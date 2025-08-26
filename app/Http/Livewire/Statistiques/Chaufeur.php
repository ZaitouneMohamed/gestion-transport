<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Consomation;
use Livewire\Component;

class Chaufeur extends Component
{
    public $chaufeur;
    public $datedebut;
    public $datefin;

    public function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
    public function render()
    {
        return view('livewire.statistiques.chaufeur', [
            "trajets" => Consomation::with(['Bons','Station','Camion','chaufeur'])->Where("chaufeur_id",  $this->chaufeur)
                ->whereBetween('date', [$this->datedebut, $this->datefin])
                ->get()
        ]);
    }
}
