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
        "description",
        "camion_id",
        "days_count",
        "last_notification",
        "date_fin"
    ];

    protected $casts = [
        'date_debut' => 'datetime', // If needed
    ];

    public function Camion()
    {
        return $this->belongsTo(Camion::class);
    }

    public function getTargetDateAttribute()
    {
        if (!$this->last_notification) {
            return null;
        }

        return Carbon::parse($this->last_notification);
    }

    public function getDaysUntilFinAttribute()
    {
        if (!$this->target_date) {
            return 'N/A';
        }

        return $this->target_date->diffForHumans(Carbon::today());
    }

    public function getTargetDateFormattedAttribute()
    {
        return $this->target_date?->format('Y-m-d'); // or any other format
    }


}
