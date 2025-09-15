<?php

namespace App\Jobs;

use App\Models\Reservation;
use App\Mail\ReservationDueReminder;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendDueReminderJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function handle()
    {
        try {
            
            if (Carbon::now()->addMinute()->gte($this->reservation->due_date)) {
               
                Mail::to($this->reservation->user->email)
                    ->send(new ReservationDueReminder($this->reservation));
            }
        } catch (\Exception $e) {
           
            Log::error("Failed to send due reminder for reservation ID {$this->reservation->id}: " . $e->getMessage());
        }
    }
}



