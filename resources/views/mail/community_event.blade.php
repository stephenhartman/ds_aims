@component('mail::message')

    ## Hello from the DePaul School of Northeast Florida!

    This email is a reminder that the upcoming Community Event, {{ $event->title }}

    @component('mail::button', ['url' => route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) ])
        Click here to verify your account
    @endcomponent

    Thanks,<br>
    The DePaul School of Northeast Florida

    @component('mail::footer')
        If you’re having trouble clicking verify button, copy and paste the URL below into your web browser: {{route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email)}}
    @endcomponent

@endcomponent
