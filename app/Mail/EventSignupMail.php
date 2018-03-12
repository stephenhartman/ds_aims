<?php

namespace App\Mail;

use App\Event;
use App\EventChild;
use App\EventSignUp;
use App\EventSignUpChild;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventSignupMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param EventSignUp $event_signup
     * @param Event $event
     * @param EventChild|null $event_child
     * @param EventSignUpChild|null $event_signup_child
     */
    public function __construct(Event $event, EventSignUp $event_signup = null, EventChild $event_child = null, EventSignUpChild $event_signup_child = null)
    {
        $this->event = $event;
        $this->event_signup = $event_signup;
        $this->event_child = $event_child;
        $this->event_signup_child = $event_signup_child;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->event_signup != null ? $this->markdown('mail.event_signup')
            ->with([
                'event' => $this->event,
                'event_signup' => $this->event_signup,
            ]) : $this->markdown('mail.event_signup_child')
            ->with([
                'event' => $this->event,
                'event_child' => $this->event_child,
                'event_signup_child' => $this->event_signup_child,
            ]);
    }
}
