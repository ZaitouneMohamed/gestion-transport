<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamionCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        "date",
        "camion_id",
        "chaufeur_id",
        "nature",
        "prix_location",
    ];

    public function Camion()
    {
        return $this->belongsTo(Camion::class);
    }
    
    public function chaufeur()
    {
        return $this->belongsTo(Chaufeur::class);
    }
}
