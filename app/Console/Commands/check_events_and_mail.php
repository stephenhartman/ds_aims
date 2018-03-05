<?php

namespace App\Console\Commands;

use App\Mail\CommunityEventMail;
use App\Mail\ReunionEventMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Event;
use App\EventSignUp;
use App\EventChild;
use App\EventSignUpChild;

class check_events_and_mail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $event_children_signups = EventSignUpChild::all();

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
                    case 'Community Event':
                        if($diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new CommunityEventMail($event_signup, $event));
                        break;
                    case 'Reunion':
                        if($diff == 180 || $diff == 30 || $diff == 7)
                        Mail::to($user->email)
                            ->send(new ReunionEventMail($event_signup, $event));
                        break;
                    case 'Volunteer':
                        if($diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new VolunteerEventMail($event_signup, $event));
                        break;
                }
            }
        }

        foreach ($event_children_signups as $event_child_signup)
        {
            if ($event_child_signup != null)
            {
                $event_child = EventChild::find($event_child_signup->child_id);
                $user = User::find($event_child_signup->user_id);
                $event = Event::find($event_child_signup->event_id);
                $date = Carbon::parse($event_child->start_date);
                $diff = $date->diffInDays($now);
                switch ($event->type)
                {
                    case 'Community Event':
                        if($diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new CommunityEventMail($event, null, $event_child, $event_child_signup));
                        break;
                    case 'Reunion':
                        if($diff == 180 || $diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new ReunionEventMail($event, null, $event_child, $event_child_signup));
                        break;
                    case 'Volunteer':
                        if($diff == 30 || $diff == 7)
                            Mail::to($user->email)
                                ->send(new VolunteerEventMail($event, null, $event_child, $event_child_signup));
                        break;
                }
            }
        }
    }
}
