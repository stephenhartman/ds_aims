<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use \Calendar;
use Auth;
use App\EventSignUp;

class EventSignUpController extends Controller
{
    public function index(Event $event)
    {
        $volunteers = EventSignUp::where('event_id', $event->id)->get();
        return view('events.event_sign_ups.index', compact('event', 'volunteers'));
    }


    public function create(Event $event)
    {
        $user = Auth::user()->id;

        return view('events.event_sign_ups.create', compact('user', 'event'));
    }

    public function store(Request $request)
    {
        $enroll = new EventSignUp;
        $enroll->user_id = $request->user_id;
        $enroll->event_id = $request->event_id;
        $enroll->number_attending = $request->number_attending;
        $enroll->notes = $request->notes;


        $enroll->save();

        return redirect()->route('events.index');
    }

    public function show(Event $event, EventSignUp $enroll)
    {
        //$event = Event::where('id',$event_id)->first();
        return view('events.event_sign_ups.show', compact('event','enroll'));
    }

    public function edit(Event $event, $enroll_id)
    {
        $user = Auth::user()->id;
        $enroll = EventSignUp::where('id', $enroll_id)->first();
        return view('events.event_sign_ups.edit', compact('event','enroll', 'user'));
    }

    public function update(Event $event, $enroll_id, Request $request)
    {
        $enroll = EventSignUp::find($enroll_id);
        $enroll->user_id = $request->user_id;
        $enroll->event_id = $request->event_id;
        $enroll->number_attending = $request->number_attending;
        $notes = $enroll->notes;
        $enroll->notes = $notes . "\n" . $request->notes;

        $enroll->save();

        return redirect()->route('events.index');
    }
    public function destroy(Event $event, $enroll_id)
    {
        $enroll = EventSignUp::where('id', $enroll_id)->first();
        $enroll->delete();
        return redirect()->route('events.index');
    }
}
