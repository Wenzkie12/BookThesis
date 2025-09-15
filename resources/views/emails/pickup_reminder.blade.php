@component('mail::message')
# Hello {{ $user->name }},

This is a reminder that your reservation for the book **{{ $reservation->book->title }}** is about to expire in 2 minute.

Please pick up the book to avoid cancelling.

@component('mail::panel')
If you have any questions, feel free to contact us.
@endcomponent

Regards,  
{{ config('app.name') }}
@endcomponent
