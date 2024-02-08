<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "solde",
        "gerant_name",
        "gerant_phone",
        "gerant_rep_name",
        "gerant_rep_phone",
        "ville"
    ];
    public function Consomations()
    {
        return $this->hasMany(Consomation::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
}
