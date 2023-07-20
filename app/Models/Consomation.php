<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consomation extends Model
{
    use HasFactory;

    protected $fillable = [
        "chaufeur_id",
        "camion_id",
        "ville",
        // "qte_litre",
        // "date",
        // "station_id",
        // "km_depart",
        // "bon",
        // "km_return",
        // "nature"
    ];
    public function Bons() {
        return $this->hasMany(Bons::class);
    }
    public function chaufeur()
    {
        return $this->belongsTo(Chaufeur::class);
    }
    public function Station()
    {
        return $this->belongsTo(Station::class);
    }
    public function Camion()
    {
        return $this->belongsTo(Camion::class);
    }
}
