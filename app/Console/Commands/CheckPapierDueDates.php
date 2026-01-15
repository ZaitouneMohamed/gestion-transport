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

    private const WARNING_DAYS = 10;

    public function handle()
    {
        $today = Carbon::today();
        $expiringPapiers = collect();

        // 1️⃣ Collect expiring papiers
        Papier::whereBetween('date_fin', [
            $today,
            $today->copy()->addDays(self::WARNING_DAYS)
        ])->chunk(100, function ($papiers) use ($today, &$expiringPapiers) {

            foreach ($papiers as $papier) {

                $diffInDays = Carbon::parse($papier->date_fin)
                    ->diffInDays($today, false);

                if ($diffInDays < 0) {
                    continue;
                }

                $expiringPapiers->push($papier);

                // 2️⃣ Update dates ONLY on last day
                if ($diffInDays === 1) {
                    $papier->update([
                        'last_notification' => $papier->last_notification
                            ? Carbon::parse($papier->last_notification)->addDay()
                            : $today,
                        'date_fin' => Carbon::parse($papier->date_fin)->addDay(),
                    ]);
                }
            }
        });

        // Stop if nothing to notify
        if ($expiringPapiers->isEmpty()) {
            $this->info('No expiring papiers found.');
            return;
        }

        // 3️⃣ Send ONE mail per user with ALL papiers
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(
                new PapierDueMail($expiringPapiers , $user->name)
            );
        }

        $this->info('Papier due-date check completed successfully.');
    }
}
