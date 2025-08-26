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
        $this->calculateDateFin($papier);
    }

    /**
     * Handle the Papier "updating" event.
     */
    public function updating(Papier $papier): void
    {
        Log::info('Updating Papier: ', $papier->toArray());
        $this->calculateDateFin($papier);
    }

    /**
     * Calculate date_fin based on last_notification + days_count.
     */
    protected function calculateDateFin(Papier $papier): void
    {
        if (!empty($papier->last_notification) && !empty($papier->days_count)) {
            $papier->date_fin = Carbon::parse($papier->last_notification)->addDays( intval($papier->days_count))->format('Y-m-d');
        }
    }
}
