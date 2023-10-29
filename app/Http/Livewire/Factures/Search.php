<?php

namespace App\Http\Livewire\Factures;

use App\Exports\FactureExport;
use App\Models\facture;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Search extends Component
{
    public $station, $datedebut, $datefin;
    public function render()
    {
        return view('livewire.factures.search', [
            "factures" => facture::where(function ($query) {
                $query->Where("station_id",  $this->station);
            })
                ->whereBetween('date', [$this->datedebut, $this->datefin])
                ->get()
        ]);
    }
    public function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }
}
