<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    use HasFactory;
    protected $fillable = [
        "matricule",
        "statue",
        "is_for_aej",
        "marque",
        "genre",
        "type_carburant",
        "n_chasie",
        "puissanse_fiscale",
        "premier_mise",
        "consommation"
    ];
    public function Consomations()
    {
        return $this->hasMany(Consomation::class);
    }
    public function Charge()
    {
        return $this->hasMany(CamionCharge::class);
    }
    public function Papiers()
    {
        return $this->hasMany(Papier::class);
    }
    public function scopeActive($query)
    {
        return $query->where("statue", 1);
    }
    public function scopeAej($query)
    {
        return $query->where("is_for_aej", 1);
    }
    public function getConsomationPrixAttribute()
    {
        $consomation = $this->Consomations();
    }
}
