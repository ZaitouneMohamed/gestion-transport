<?php

namespace App\Console\Commands;

use App\Mail\PapierDueMail;
use App\Models\Papier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckPapierDueDates extends Command
{
    protected $signature = 'check:papier-due-dates';
    protected $description = 'Check for Papier entries nearing their end date and notify users';

    public function handle()
    {
        $today = Carbon::today();

        // STEP 1: First, update any papiers that have passed their date_fin
        $this->updateOverduePapiers($today);

        // STEP 2: Then get papiers that are due within 10 days for notification
        $papiers = Papier::whereNotNull('date_fin')
            ->whereNotNull('days_count')
            ->get()
            ->filter(function ($papier) use ($today) {
                $daysUntil = $today->diffInDays($papier->date_fin, false);
                return $daysUntil >= 0 && $daysUntil <= 10;
            });

        if ($papiers->isEmpty()) {
            $this->info("No papiers due within the next 10 days.");
            return 0;
        }

        // STEP 3: Send notifications
        $users = User::all();

        if ($users->isEmpty()) {
            $this->warn("No users found to send notifications.");
            return 0;
        }

        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(new PapierDueMail($papiers, $user->name));
                $this->info("Notification sent to {$user->email}");
            } catch (\Exception $e) {
                $this->error("Failed to send email to {$user->email}: " . $e->getMessage());
            }
        }

        $this->info("Notifications sent to " . $users->count() . " user(s) for " . $papiers->count() . " papier(s).");
        return 0;
    }

    /**
     * Update all papiers that have passed their date_fin
     */
    private function updateOverduePapiers($today)
    {
        $overduePapiers = Papier::whereNotNull('date_fin')
            ->whereNotNull('days_count')
            ->where('date_fin', '<=', $today)
            ->get();

        if ($overduePapiers->isEmpty()) {
            $this->info("No overdue papiers to update.");
            return;
        }

        $this->info("Found " . $overduePapiers->count() . " overdue papier(s) to update.");

        foreach ($overduePapiers as $papier) {
            $oldDateFin = $papier->date_fin->format('Y-m-d');

            // Calculate how many cycles we need to add to bring date_fin to the future
            $daysPassed = $today->diffInDays($papier->date_fin);
            $cyclesToAdd = ceil($daysPassed / $papier->days_count);

            // If date_fin is today, just add one cycle
            if ($cyclesToAdd == 0) {
                $cyclesToAdd = 1;
            }

            $newDateFin = $papier->date_fin->copy()->addDays($cyclesToAdd * $papier->days_count);

            // Set last_notification to the old date_fin (when it was actually due)
            $papier->update([
                'last_notification' => $papier->date_fin,
                'date_fin' => $newDateFin,
            ]);

            $this->info("Updated Papier ID {$papier->id} ({$papier->title}): {$oldDateFin} -> {$newDateFin->format('Y-m-d')}");
        }
    }
}
