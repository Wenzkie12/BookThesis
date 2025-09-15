<?php

namespace App\Jobs;

use App\Mail\PickupReminderMail;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendPickupReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function handle()
    {
        try {
            $user = $this->reservation->user;
            if ($user && $user->email) {
               
                Log::info("Sending email to: {$user->email} for reservation ID: {$this->reservation->id}");
    
                
                Mail::to($user->email)
                    ->send(new PickupReminderMail($this->reservation));
    
            
                Log::info("Successfully sent email to: {$user->email} for reservation ID: {$this->reservation->id}");
            }
        } catch (\Exception $e) {
    
            Log::error("Failed to send pickup reminder for reservation ID {$this->reservation->id}: " . $e->getMessage());
        }
    }
}
