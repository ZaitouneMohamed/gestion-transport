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
        "station_id",
        "ville",
        "numero_bon",
        "km_return",
        "nature"
    ];
    public function Consomation() {
        return $this->belongsTo(Consomation::class);
    }
}
