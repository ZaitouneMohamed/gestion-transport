<?php

namespace App\Http\Livewire;

use App\Models\Camion;
use App\Models\Consomation;
use Livewire\Component;

class CamionStatistique extends Component
{
    public $camion, $statistiques, $date_debut, $date_fin , $camion_info;
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
        $this->camion_info = Camion::find($this->camion);
        // $consomation = Consomation::where('camion_id',$this->camion)->get();
        return Consomation::where('camion_id',$this->camion)->get();
    }
}
