<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->subject('Payment Receipt')
                    ->markdown('emails.payment.receipt')
                    ->with([
                        'payment' => $this->payment,
                        'user' => $this->payment->profile->user,
                    ]);
    }
}
