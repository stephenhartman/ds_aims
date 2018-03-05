<?php

namespace App\Console\Commands;

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
        $event_signups = EventSignUp::all();
        $event_children_signups = EventSignUpChild::all();
        foreach ($event_signups as $signup)
        {
            $event = Event::where($signup->event_id);
            switch ($event->type)
            {
                case 'Community Event':
                    break;
                case 'Reunion':
                    break;
                case 'Volunteer':
                    break;
            }
        }
    }
}
