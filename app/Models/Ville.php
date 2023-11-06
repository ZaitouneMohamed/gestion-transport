<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "km_proposer"
    ];
    public function Missions()
    {
        return $this->hasMany(Mission::class);
    }
}
