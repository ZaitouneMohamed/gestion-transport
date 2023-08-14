<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Bons;
use Livewire\Component;

class Station extends Component
{
    function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
    public $station , $nature , $datedebut , $datefin;
    public function render()
    {
        return view('livewire.statistiques.station',[
            "trajets" => Bons::where(function ($query) {
                $query->Where("station_id",  $this->station);
                $query->Where("nature",  $this->nature);
            })
                ->whereBetween('date', [$this->datedebut, $this->datefin])
                ->get()
        ]);
    }
}
