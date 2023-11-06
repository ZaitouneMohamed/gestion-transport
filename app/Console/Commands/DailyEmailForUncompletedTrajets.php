<?php

namespace App\Console\Commands;

use App\Models\Consomation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyEmailForUncompletedTrajets extends Command
{
    protected $signature = 'email:uncompleted-trajets';
    protected $description = 'Send daily email for uncompleted trajets';

    public function handle()
    {
        $trajets = Consomation::where('status', 0)->get();

        if ($trajets->isNotEmpty()) {
            Mail::send('Mail.TestMail', ['trajets' => $trajets], function ($message) {
                $message->to('Yousseftrih59@gmail.com')
                    ->subject('Uncompleted Trajets');
            });
        }
    }
}
