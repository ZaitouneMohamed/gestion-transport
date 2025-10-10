<?php
namespace App\Http\Livewire\Statistiques;

use App\Models\Consomation;
use Livewire\Component;

class All extends Component
{
    public $chaufeur;
    public $datedebut;
    public $datefin ;
    public $camion ;
    public $ville ;

    public function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }

    public function render()
    {
        $query = Consomation::with(['Bons', 'Station', 'Camion', 'chaufeur']);

        if ($this->datedebut && $this->datefin) {
            $query->whereBetween('date', [$this->datedebut, $this->datefin]);
        }

        if (($this->chaufeur)) {
            $query->where("chaufeur_id", $this->chaufeur);
        }
        if (($this->camion)) {
            $query->where("camion_id", $this->camion);
        }
        if (($this->ville)) {
            $query->where("ville", $this->ville);
        }

        return view('livewire.statistiques.all', [
            "trajets" => $query->get()
        ]);
    }
}
