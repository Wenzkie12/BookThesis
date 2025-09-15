<?php

namespace App\Console\Commands;

use App\Mail\PickupReminderMail;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendPickupReminder extends Command
{
    protected $signature = 'reminders:pickup';
    protected $description = 'Send pickup reminder emails 1 minute before the pickup time';

    public function handle()
    {
        $now = Carbon::now()->startOfSecond();
        $oneMinuteFromNow = $now->copy()->addMinute();


        Reservation::where('status', 'to_claim')
            ->whereBetween('pickup_date', [$now, $oneMinuteFromNow])
            ->chunk(100, function ($reservations) {
                foreach ($reservations as $reservation) {
                    try {
                        $user = $reservation->user;
                        if ($user && $user->email) {
                            // Directly send the email without queuing
                            Mail::to($user->email)
                                ->send(new PickupReminderMail($reservation));

                            Log::info("Pickup reminder email sent to: {$user->email} for reservation ID: {$reservation->id}");
                        }
                    } catch (\Exception $e) {
                        Log::error("Failed to send reminder email for reservation ID: {$reservation->id} - " . $e->getMessage());
                    }
                }
            });
    }
}
