<?php

namespace App\Http\Livewire\Statistiques;

use App\Models\Bons as ModelsBons;
use Livewire\Component;

class Bons extends Component
{
    public $date;
    public $numero;

    public function mount()
    {
        $this->date = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.statistiques.bons', [
            "bons" => ModelsBons::where(function ($query) {
                $query->Where("numero_bon",  $this->numero);
            })
                // ->where('date', $this->date)
                ->get()
        ]);
    }
}
