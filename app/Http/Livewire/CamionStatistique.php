<?php

namespace App\Http\Livewire;

use App\Models\Consomation;
use Livewire\Component;

class CamionStatistique extends Component
{
    public $camion, $statistiques, $date_debut, $date_fin;
    function mount()
    {
        $this->date_debut = date('Y-m-d');
        $this->date_fin = date('Y-m-d');
    }
    public function render()
    {
        return view('livewire.camion-statistique');
    }
    function getConsomationsProperty()
    {
        return Consomation::where('camion_id', $this->camion)->whereBetween('date', [$this->date_debut, $this->date_fin])->get();
    }
}
