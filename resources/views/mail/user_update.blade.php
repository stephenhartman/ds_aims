@component('mail::message')

# Hello from the DePaul School of Northeast Florida!

Congratulations {{ $user->name }}!  It has been {{ $year }} years since you have registered with the DePaul Alumni Outreach System!

Now is a great time to update your alumni account!  Please click the button below to login and add new milestones to your account!

@component('mail::button', ['url' => route('users.show', $user->id)])
    Click here to view your account
@endcomponent

Thanks again for being an active member of the DePaul Community.

Thanks,<br>
The DePaul School of Northeast Florida

@component('mail::footer')
    If you’re having trouble clicking the event button, copy and paste the URL below into your web browser: {{ route('users.show', $user->id) }}
@endcomponent

@endcomponent
