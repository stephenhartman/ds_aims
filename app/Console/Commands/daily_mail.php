<?php

namespace App\Console\Commands;

use App\Mail\EventSignupMail;
use App\Mail\ReunionEventMail;
use App\Mail\UpdateUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Event;
use App\EventSignUp;
use App\EventChild;
use App\EventSignUpChild;
use Illuminate\Support\Facades\Mail;

class daily_mail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:daily_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Chron job to mail based on event signups and user creation date.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();
        $event_signups = EventSignUp::all();
        $event_signups_children = EventSignUpChild::all();
        $users = User::has('alumnus')->get();

        foreach ($event_signups as $event_signup)
        {
            if ($event_signup->deleted_at == null)
            {
                $event = Event::find($event_signup->event_id);
                $user = User::find($event_signup->user_id);
                $date = Carbon::parse($event->start_date);
                $diff = $date->diffInDays($now);
                switch ($event->type)
                {
                    case 'Community':
                        if($diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new EventSignupMail($event, $event_signup));
                        break;
                    case 'Reunion':
                        if($diff == 365 || $diff == 180 || $diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new EventSignupMail($event, $event_signup));
                        break;
                    case 'Volunteer':
                        if($diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new EventSignupMail($event, $event_signup));
                        break;
                }
            }
        }

        foreach ($event_signups_children as $event_signup_child)
        {
            if ($event_signup_child->deleted_at == null)
            {
                $event_child = EventChild::find($event_signup_child->child_id);
                $user = User::find($event_signup_child->user_id);
                $event = Event::find($event_signup_child->event_id);
                $date = Carbon::parse($event_child->start_date);
                $diff = $date->diffInDays($now);
                switch ($event->type)
                {
                    case 'Community':
                        if($diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new EventSignupMail($event, null, $event_child, $event_signup_child));
                        break;
                    case 'Reunion':
                        if($diff == 365 || $diff == 180 || $diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new EventSignupMail($event, null, $event_child, $event_signup_child));
                        break;
                    case 'Volunteer':
                        if($diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new EventSignupMail($event, null, $event_child, $event_signup_child));
                        break;
                }
            }
        }
        foreach ($users as $user)
        {
            $date = Carbon::parse($user->created_at);
            $diff = $date->diffInDays($now);
            $year = $date->diffInYears($now);
            if ($diff % 365 == 0)
                Mail::to($user->email)
                    ->send(new UpdateUser($user, $year));
        }

    }
}
