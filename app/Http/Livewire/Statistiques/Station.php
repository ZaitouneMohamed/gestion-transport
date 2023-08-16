<?php
namespace App\Http\Livewire\Statistiques;

use App\Models\Bons;
use Livewire\Component;

class Station extends Component
{
    public $station, $nature, $datedebut, $datefin, $statue;

    public function mount()
    {
        $this->datedebut = date('Y-m-d');
        $this->datefin = date('Y-m-d');
    }

    public function render()
    {
        $query = Bons::query();

        if (empty($this->station) && empty($this->nature)) {
            $this->statue = "station is not set and nature is not set";
        } elseif (!empty($this->station) && empty($this->nature)) {
            $this->statue = "station is set and nature is not set";
            $query->where('station_id', $this->station);
        } elseif (empty($this->station) && !empty($this->nature)) {
            $this->statue = "station is not set and nature is set";
            $query->where('nature', $this->nature);
        } else {
            $this->statue = "station is set and nature is set";
            $query->where('nature', $this->nature)->where('station_id', $this->station);
        }

        $bons = $query->whereBetween('date', [$this->datedebut, $this->datefin])
            ->get();

        return view('livewire.statistiques.station', [
            'bons' => $bons,
        ]);
    }
}
