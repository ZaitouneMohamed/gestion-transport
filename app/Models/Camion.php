<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    use HasFactory;
    protected $fillable = [
        "matricule",
        "consommation"
    ];
    public function Consomations()
    {
        return $this->hasMany(Consomation::class);
    }

    public function getConsomationPrixAttribute()
    {
        $consomation = $this->Consomations();
    }
}