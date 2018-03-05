<?php

namespace App\Console\Commands;

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

        foreach ($event_signups as $signup)
        {
            $event = Event::find($signup->event_id);
            $date = Carbon::parse($event->start_date);
            $diff = $date->diffInDays($now);
            switch ($event->type)
            {
                case 'Community Event':
                    if($diff == 30 || $diff == 7)
                        Mail::send();
                    break;
                case 'Reunion':
                    if($diff == 180 || $diff == 30 || $diff == 7)
                        Mail::send();
                    break;
                case 'Volunteer':
                    if($diff == 30 || $diff == 7)
                        Mail::send();
                    break;
            }
        }

        foreach ($event_children_signups as $signup)
        {
            $event_child = EventChild::find($signup->event_id);
            $event_parent = Event::find($event_child->parent_id);
            $date = Carbon::parse($event_child->start_date);
            $diff = $date->diffInDays($now);
            switch ($event_parent->type)
            {
                case 'Community Event':
                    if($diff == 30 || $diff == 7)
                        Mail::send();
                    break;
                case 'Reunion':
                    if($diff == 180 || $diff == 30 || $diff == 7)
                        Mail::send();
                    break;
                case 'Volunteer':
                    if($diff == 30 || $diff == 7)
                        Mail::send();
                    break;
            }
        }
    }
}
