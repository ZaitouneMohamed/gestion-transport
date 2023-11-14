<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Mission as ModelsMission;
use Livewire\Component;

class Mission extends Component
{
    function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
    public $chaufeur, $datedebut, $datefin;
    public function render()
    {
        return view('livewire.statistiques.mission', [
            "missions" => ModelsMission::Where("chaufeur_id",  $this->chaufeur)
                ->whereBetween('date', [$this->datedebut, $this->datefin])
                ->with(['chaufeur', 'Ville', 'Camion'])
                ->get()
        ]);
    }
}
