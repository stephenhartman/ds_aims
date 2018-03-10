@component('mail::message')

# Hello from the DePaul School of Northeast Florida!

This email is a reminder that you signed up for the upcoming Reunion Event:

## {{ $event->title }}

The event will be taking place on {{ Carbon::parse($event_child->start_date)->format('l\, F jS Y \a\t g:i A') }}.

Event Description: {{ $event->description }}

@if ($event_child->update !== NULL)
    Event Additional Notes: {{ $event_child->updates }}
@endif

Number attending: {{ $event_signup_child->number_attending }}

Notes: {{ $event_signup_child->notes }}

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

