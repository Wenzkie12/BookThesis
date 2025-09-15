<?php

namespace App\Jobs;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoCancelReservationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function handle()
    {
        if (
            $this->reservation->status === 'to_claim' &&
            Carbon::now()->greaterThan(Carbon::parse($this->reservation->pickup_date))
        ) {
            $this->reservation->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);
        }
    }
}
