<?php

namespace App\Http\Livewire\Factures;

use App\Models\facture;
use Livewire\Component;

class Crud extends Component
{
    public $date, $prix, $station_id, $n_bon, $factures;
    public function render()
    {
        return view('livewire.factures.crud');
    }
    public function mount()
    {
        $this->GetFacturesList();
        $this->date = date('Y-m-d');
    }
    public function GetFacturesList()
    {
        $this->factures = facture::latest()->get();
    }
    public function AddBon()
    {
        $this->validate();
        $facture = facture::create([
            "date" => $this->date,
            "prix" => $this->prix,
            "station_id" => $this->station_id,
            "n_bon" => $this->n_bon,
        ]);
        $this->reset();
        session()->flash('message', 'User successfully added');
        $this->GetFacturesList();
    }

    public function DeleteFacture($id)
    {
        $facture = facture::find($id);
        $facture->delete();
        session()->flash('message', 'User successfully added');
        $this->GetFacturesList();
    }

    protected $rules = [
        "date" => "required",
        "prix" => "required",
        "station_id" => "required",
        "n_bon" => "required",
    ];
}
