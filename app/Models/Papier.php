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
        "date_fin",
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'last_notification' => 'datetime',
    ];

    public function Camion()
    {
        return $this->belongsTo(Camion::class);
    }

    /**
     * Get formatted date_fin for display
     */
    public function getTargetDateFormattedAttribute()
    {
        if (!$this->date_fin) {
            return 'N/A';
        }

        return $this->date_fin->format('Y-m-d');
    }

    /**
     * Get days until date_fin (always positive since date_fin is rolled forward)
     */
    public function getDaysUntilNextNotificationAttribute()
    {
        try {
            if (!$this->date_fin) {
                return null;
            }

            return Carbon::today()->diffInDays($this->date_fin, false);

        } catch (\Exception $e) {
            return null;
        }
    }

}
