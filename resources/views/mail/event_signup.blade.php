@component('mail::message')

# Hello from the DePaul School of Northeast Florida!

This email is a reminder that you signed up for the upcoming {{ $event->type }} Event:

## {{ $event->title }}

The event will be taking place on {{ Carbon::parse($event->start_date)->format('l\, F jS Y \a\t g:i A') }}.

Event Location: {{ $event->location }}

@component('mail::button', ['url' => $event->location_url, 'target' => '_blank', 'color' => 'green'])
    Click here to view the event location
@endcomponent

Event Description: {{ $event->description }}

Number attending: {{ $event_signup->number_attending }}

Notes: {{ $event_signup->notes }}

@component('mail::button', ['url' => route('events.index')])
    Click here to view the event
@endcomponent

We hope to see you there!

Thanks,<br>
The DePaul School of Northeast Florida

@component('mail::footer')
    If you’re having trouble clicking the event button, copy and paste the URL below into your web browser: {{ route('events.index') }}
@endcomponent

@endcomponent
