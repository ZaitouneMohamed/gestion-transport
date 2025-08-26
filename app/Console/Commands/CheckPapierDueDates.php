<?php

namespace App\Console\Commands;

use App\Mail\PapierDueMail;
use App\Models\Papier;
use App\Models\User;
use App\Notifications\PapierDueNotification;
use Carbon\Carbon;
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
        $data = Papier::all();

        foreach ($data as $item) {

            $targetDate = Carbon::parse($item->last_notification)->copy()->addDays($item->days_count);
            //
            $todaydate = Carbon::today();

            $diff = $todaydate->diffInDays($targetDate);

            if ($diff <= 10) {

                Notification::send(User::all(), new PapierDueNotification($item));

                foreach (User::all() as $user) {
                    Mail::to($user->email)->send(new PapierDueMail($item, $user->name));
                }

                if ($diff === 0) {
                    $item->update([
                        "last_notification" => Carbon::today()
                    ]);
                }

            }
        }
    }
}
