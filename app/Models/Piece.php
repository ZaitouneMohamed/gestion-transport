<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;

    protected $fillable = [
        "chaufeur_id",
        "camion_id",
        "date",
        "piece",
        "fournisseur",
        "prix",
        "nature"
    ];

    public function Chaufeur()
    {
        return $this->belongsTo(Chaufeur::class);
    }

    public function Camion()
    {
        return $this->belongsTo(Camion::class);
    }
}
