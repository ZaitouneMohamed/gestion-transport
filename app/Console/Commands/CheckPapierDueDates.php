<?php

namespace App\Console\Commands;

use App\Models\Papier;
use App\Models\User;
use App\Notifications\PapierDueNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;

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
        $papers = Papier::where('date_fin', '<=', Carbon::now()->addDays(10))
            ->where('date_fin', '>=', Carbon::now())
            ->get();

        if ($papers->isNotEmpty()) {
            Notification::send(User::all(), new PapierDueNotification($papers));
            $this->info('Users notified about upcoming Papier entries.');
        } else {
            $this->info('No Papier entries due in the next 10 days.');
        }
    }
}
