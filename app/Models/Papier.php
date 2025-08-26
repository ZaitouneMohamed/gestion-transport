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
        'date_fin' => 'datetime',
        'date_debut' => 'datetime', // If needed
    ];

    public function Camion()
    {
        return $this->belongsTo(Camion::class);
    }

    public function getDaysUntilFinAttribute()
    {
        $last_notification = Carbon::parse($this->last_notification);
        $daysCount = $this->days_count;
        //
        $targetDate = $last_notification->copy()->addDays($daysCount);

        return $targetDate->diffForHumans(Carbon::today());
    }

    public function getTargetDateAttribute()
    {
        $last_notification = Carbon::parse($this->last_notification);
        $daysCount = $this->days_count;
        return $last_notification->copy()->addDays($daysCount);
    }


    public function getTargetDateFormattedAttribute()
    {
        return $this->target_date?->format('Y-m-d'); // or any other format
    }


}
