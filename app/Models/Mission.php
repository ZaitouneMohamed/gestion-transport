<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        "chaufeur_id", "camion_id", "ville_id", "date", "km_total", "nombre_magasin" , "numero_bon" , "description"
    ];
    public function chaufeur()
    {
        return $this->belongsTo(Chaufeur::class);
    }
    public function Ville()
    {
        return $this->belongsTo(Ville::class);
    }
    public function Camion()
    {
        return $this->belongsTo(Camion::class);
    }
}
