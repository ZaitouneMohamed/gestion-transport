<?php

namespace App\Http\Livewire\Factures;

use App\Models\facture;
use App\Models\Station;
use Livewire\Component;

class TotalGenerale extends Component
{
    public $datedebut, $datefin, $type;
    public function render()
    {
        $station_id = Station::where('name', 'DIVERS')->first();
        $query = Facture::where('station_id', '!=', $station_id->id)
            ->whereBetween('date', [$this->datedebut, $this->datefin]);

        // Check if type is defined, and if so, add it to the query
        if ($this->type !== "") {
            $query->where('type', $this->type);
        }

        $factures = $query->get();

        return view('livewire.factures.total-generale', [
            "factures" => $factures
        ]);
    }
    public function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
}
