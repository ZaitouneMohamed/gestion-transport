<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papier extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "date_debut",
        "date_fin",
        "description",
        "camion_id",
        "days_count"
    ];

    protected $casts = [
        'date_fin' => 'datetime',
        'date_debut' => 'datetime', // If needed
    ];

    public function Camion()
    {
        return $this->belongsTo(Camion::class);
    }

    public function getDaysUntilFinAttribute()
    {
        return $this->date_fin->diffForHumans(Carbon::today());
    }

    public function getProgressPercentageAttribute()
    {
        $totalDuration = $this->date_debut->diffInDays($this->date_fin);
        $elapsedDuration = $this->date_debut->diffInDays(Carbon::today());

        // Calculate progress percentage, ensuring it does not exceed 100%
        $percentage = ($elapsedDuration / $totalDuration) * 100;
        return min(max($percentage, 0), 100); // Clamp between 0 and 100
    }
}
