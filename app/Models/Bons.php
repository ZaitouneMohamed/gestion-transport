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
        "description",
        "prix",
        "station_id",
        "numero_bon",
        "km",
        "nature"
    ];

    protected $casts = ['date' => 'date'];

    public function scopeGazole($query)
    {
        return $query->where("nature", 'gazole');
    }
    public function Consomation()
    {
        return $this->belongsTo(Consomation::class);
    }
    public function Station()
    {
        return $this->belongsTo(Station::class);
    }
}
