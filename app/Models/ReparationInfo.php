<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReparationInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'reparation_id',
        'camion_id',
        'chaufeur_id',
        'prix',
        'date',
        'nature',
        'type_id',
    ];

    public function reparation()
    {
        return $this->belongsTo(Reparation::class);
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }

    public function chaufeur()
    {
        return $this->belongsTo(Chaufeur::class);
    }

    public function type()
    {
        return $this->belongsTo(Natures::class);
    }
}
