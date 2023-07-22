<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bons extends Model
{
    use HasFactory;
    protected $fillable = [
        "consomation_id",
        "date",
        "qte_litre",
        "prix",
        "station_id",
        "numero_bon",
        "km",
        "nature"
    ];
    public function Consomation() {
        return $this->belongsTo(Consomation::class);
    }
}
