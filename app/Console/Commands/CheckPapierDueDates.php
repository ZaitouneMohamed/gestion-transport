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

        // Get all papiers that are due in 10 days or less
        $papiers = Papier::all()->filter(function ($item) use ($today) {
            $targetDate = Carbon::parse($item->last_notification)->copy()->addDays($item->days_count);
            $diff = $today->diffInDays($targetDate, false); // false = allow negative diff
            return $diff <= 10;
        });

        if ($papiers->isEmpty()) {
            $this->info("No papiers due within the next 10 days.");
            return;
        }

        // Send one email to each user with the full list
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new PapierDueMail($papiers, $user->name));
        }

        // Update last_notification for those due today
        foreach ($papiers as $papier) {
            $targetDate = Carbon::parse($papier->last_notification)->copy()->addDays($papier->days_count);
            if ($targetDate->isSameDay($today)) {
                $papier->update([
                    'last_notification' => $today
                ]);
            }
        }

        $this->info("Notifications sent successfully.");
    }
}
