<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facture extends Model
{
    use HasFactory;

    protected $fillable = [
        "date",
        "prix",
        "station_id",
        "type",
        "n_bon",
        "km"
    ];

    public function Station()
    {
        return $this->belongsTo(Station::class);
    }
}
