@component('mail::message')

    Thank you for signing up with the DePaul Alumni Outreach System!
    We are excited to offer you all of the features, but first we need you to verify this email by clicking on the button below.


    @component('mail::button', ['url' => route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) ])
        Click here to verify your account
    @endcomponent

    Thanks,<br>
    The DePaul School of Northeast Florida

    @component('mail::footer')
        If you’re having trouble clicking verify button, copy and paste the URL below into your web browser: {{route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email)}}
    @endcomponent

@endcomponent

