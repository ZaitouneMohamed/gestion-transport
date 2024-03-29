<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chaufeur extends Model
{
    use HasFactory;
    protected $fillable = [
        "full_name", "phone",
        "code", "numero_2",
        "email", "cnss",
        "cni",
        "adresse", "statue",
    ];
    public function Consomations()
    {
        return $this->hasMany(Consomation::class);
    }
    public function scopeActive($query)
    {
        return $query->where("statue", 1);
    }
}
