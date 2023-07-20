<?php

namespace App\Http\Livewire;

use App\Models\Consomation;
use Livewire\Component;

class StationStatistique extends Component
{
    public $station, $statistiques, $date_debut, $date_fin;

    public function render()
    {
        return view('livewire.station-statistique');
    }
    function mount()
    {
        $this->date_debut = date('Y-m-d');
        $this->date_fin = date('Y-m-d');
    }
    function getConsomationsProperty()
    {
        return Consomation::where('station_id', $this->station)->whereBetween('date', [$this->date_debut, $this->date_fin])->get();
    }
}
