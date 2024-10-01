<?php

namespace App\Console\Commands;

use App\Mail\PapierDueMail;
use App\Models\Papier;
use App\Models\User;
use App\Notifications\PapierDueNotification;
use Carbon\Carbon;
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
                // Send notification to all users for this specific Papier
                Notification::send(User::all(), new PapierDueNotification($papier));

                // Send email for this specific Papier to all users
                foreach (User::all() as $user) {
                    Mail::to($user->email)->send(new PapierDueMail($user->name , $papier)); // Ensure you have a Mailable for this
                }
            }
            $this->info('Users notified about upcoming Papier entries.');
        } else {
            $this->info('No Papier entries due in the next 10 days.');
        }
    }
}
