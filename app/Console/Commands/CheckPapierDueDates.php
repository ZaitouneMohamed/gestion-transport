<?php

namespace App\Console\Commands;

use App\Mail\PapierDueMail;
use App\Models\Papier;
use App\Models\User;
use App\Notifications\PapierDueNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckPapierDueDates extends Command
{
    protected $signature = 'check:papier-due-dates';
    protected $description = 'Check for Papier entries nearing their end date and notify users';
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $papers = Papier::where('date_fin', '<=', now()->addDays(10))
            ->where('date_fin', '>=', now())
            ->get();

        if ($papers->isNotEmpty()) {
            foreach ($papers as $papier) {
                Notification::send(User::all(), new PapierDueNotification($papier));

                foreach (User::all() as $user) {
                    Mail::to($user->email)->send(new PapierDueMail($papier, $user->name));
                }
            }
            Log::info('Users notified about upcoming Papier entries.');
        } else {
            Log::info('No Papier entries due in the next 10 days.');
        }
    }
}
