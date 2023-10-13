<?php

namespace App\Http\Livewire\Factures;

use App\Models\facture;
use App\Models\Station;
use Livewire\Component;

class TotalGenerale extends Component
{
    public $datedebut, $datefin;
    public function render()
    {
        $station_id = Station::where('name','DIVERS')->first();
        return view('livewire.factures.total-generale', [
            "factures" => facture::where('station_id','!=',$station_id->id)
                ->whereBetween('date', [$this->datedebut, $this->datefin])
                ->get()
        ]);
    }
    public function mount() {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
}
