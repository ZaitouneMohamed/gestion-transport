<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BackUpWeeklyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the backup process weekly';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('backup:run', ['--only-db' => true]);

        $this->info('Backup completed successfully.');

        return Command::SUCCESS;
    }
}
