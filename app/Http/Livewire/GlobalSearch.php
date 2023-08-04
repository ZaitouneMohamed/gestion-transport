<?php

namespace App\Http\Livewire;

use App\Models\Consomation;
use App\Models\User;
use Livewire\Component;

class GlobalSearch extends Component
{
    public $camion, $chaufeur, $destination, $datedebut, $datefin;

    function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.global-search', [
            "trajets" => Consomation::where(function ($query) {
                $query->where("camion_id", $this->camion)
                    ->orWhere("chaufeur_id",  $this->chaufeur)
                    ->orWhere("ville",  $this->destination);
            })
                ->whereBetween('created_at', [$this->datedebut, $this->datefin])
                ->get()
        ]);
    }
}
