<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Natures extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "type"
    ];
    public function scopeBons($query)
    {
        $query->where('type', 'bons');
    }
    public function scopeAchat($query)
    {
        $query->where('type', 'achat');
    }
}
