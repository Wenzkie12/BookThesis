<?php

namespace App\Console\Commands;

use App\Jobs\AutoCancelReservationJob;
use App\Models\Reservation;
use Illuminate\Console\Command;

class AutoCancelReservations extends Command
{
    protected $signature = 'reservations:auto-cancel';
    protected $description = 'Cancel reservations with status "to_claim" past their pickup date';

    public function handle()
    {
        // Get all 'to_claim' reservations
        $reservations = Reservation::where('status', 'to_claim')
            ->where('pickup_date', '<', now())
            ->get();

        foreach ($reservations as $reservation) {
            AutoCancelReservationJob::dispatch($reservation);
        }

        $this->info('All overdue reservations have been auto-canceled.');
    }
}
