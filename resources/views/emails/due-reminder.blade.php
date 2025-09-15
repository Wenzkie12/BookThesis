@component('mail::message')
# Hello {{ $user->name }},

This is a reminder that your reservation for the book **{{ $reservation->book->title }}** is about to expire in 1 hour.

Please return the book by the due date to avoid penalties.

@component('mail::panel')
If you have any questions, feel free to contact us.
@endcomponent

Regards,  
{{ config('app.name') }}
@endcomponent
