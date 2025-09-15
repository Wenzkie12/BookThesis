<?php

namespace App\Console\Commands;

use App\Jobs\SendDueReminderJob;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendDueReminderCommand extends Command
{
    protected $signature = 'send:due-reminder';

    protected $description = 'Send a reminder to users for reservations that are about to expire in 1 minute';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      
        $reservations = Reservation::where('status', 'to_return')
            ->where('due_date', '>=', Carbon::now()) 
            ->where('due_date', '<=', Carbon::now()->addMinute()) 
            ->with('user') 
            ->get();

        foreach ($reservations as $reservation) {
            
            dispatch(new SendDueReminderJob($reservation));
            $this->info('Reminder sent to user: ' . $reservation->user->email);
        }
    }
}

