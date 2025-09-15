<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ApplyPenaltyJob;

class RunApplyPenaltyJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:apply-penalty';  // The command you will run in the terminal

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the ApplyPenaltyJob manually';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Dispatch the job
        ApplyPenaltyJob::dispatch();

        // Optionally, you can log a message when the job is dispatched
        $this->info('ApplyPenaltyJob has been dispatched.');
    }
}
