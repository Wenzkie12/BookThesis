<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationDueReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('Reservation Due Reminder')
                    ->markdown('emails.due-reminder') 
                    ->with([
                        'reservation' => $this->reservation,
                        'user' => $this->reservation->user,
                    ]);
    }
}

