@component('mail::message')
# Hello {{ $user->name }},

Your payment has been successfully recorded.

**Amount Paid:** ₱{{ number_format($payment->amount, 2) }}  
**Reference Number:** {{ $payment->reference_number }}  
**Date:** {{ $payment->payment_date->format('F d, Y h:i A') }}

@component('mail::panel')
Thank you for settling your penalty.
@endcomponent

Regards,  
{{ config('app.name') }}
@endcomponent
