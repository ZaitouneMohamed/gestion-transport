<?php

namespace App\Observers;

use App\Models\Papier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

final class PapierObserver
{
    /**
     * Handle the Papier "creating" event.
     */
    public function creating(Papier $papier): void
    {
        $this->calculateDaysCount($papier);
    }

    /**
     * Handle the Papier "updating" event.
     */
    public function updating(Papier $papier): void
    {
        Log::info('Updating Papier: ', $papier->toArray());
        $this->calculateDaysCount($papier);
    }

    /**
     * Calculate days_count based on difference between date_fin and last_notification.
     */
    protected function calculateDaysCount(Papier $papier): void
    {
        if (!empty($papier->last_notification) && !empty($papier->date_fin)) {
            $lastNotification = Carbon::parse($papier->last_notification);
            $dateFin = Carbon::parse($papier->date_fin);

            // This gives signed difference (negative if date_fin is before last_notification)
            $papier->days_count = $lastNotification->diffInDays($dateFin, false);
        }
    }
}

