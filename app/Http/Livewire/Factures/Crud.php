<?php

namespace App\Http\Livewire\Factures;

use App\Models\facture;
use Livewire\Component;

class Crud extends Component
{
    public $date, $prix, $station_id, $n_bon, $factures, $facture_id, $editing;
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
        session()->flash('message', 'User successfully added');
        $this->GetFacturesList();
    }

    public function DeleteFacture($id)
    {
        $facture = facture::find($id);
        $facture->delete();
        session()->flash('message', 'facture successfully deleted');
        $this->GetFacturesList();
    }
    public function edit($id)
    {
        $facture = facture::find($id);
        $this->n_bon = $facture->n_bon;
        $this->date = $facture->date;
        $this->prix = $facture->prix;
        $this->station_id = $facture->station_id;
        $this->facture_id = $facture->id;
        $this->editing = true;
    }
    public function cancel()
    {
        $this->editing = false;
        $this->n_bon = "";
        $this->date = "";
        $this->prix = "";
        $this->station_id = "";
        $this->facture_id = "";
        // $this->GetFacturesList();
    }
    public function update()
    {
        $facture = facture::find($this->facture_id);
        $facture->update([
            "date" => $this->date,
            "prix" => $this->prix,
            "station_id" => $this->station_id,
            "n_bon" => $this->n_bon,
        ]);
        session()->flash('message', 'facture successfully updated');
        $this->GetFacturesList();
        $this->cancel();
    }
    protected $rules = [
        "date" => "required",
        "prix" => "required",
        "station_id" => "required",
        "n_bon" => "required",
    ];
}
