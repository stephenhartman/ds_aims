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
use App\User_Sign_Up;

class User_Sign_Up_Controller extends Controller
{
    public function index(Event $event)
    {
        $volunteers = User_Sign_Up::where('event_id', $event->id)->get();
        return view('events.user_sign_up.index', compact('event', 'volunteers'));
    }


    public function create(Event $event)
    {
        $user = Auth::user()->id;

        return view('events.user_sign_up.create', compact('user', 'event'));
    }

    public function store(Request $request)
    {
        $enroll = new User_Sign_Up;
        $enroll->user_id = $request->user_id;
        $enroll->event_id = $request->event_id;
        $enroll->number_attending = $request->number_attending;
        $enroll->notes = $request->notes;
        $enroll->unenroll = false;

        $enroll->save();

        return redirect()->route('events.index');
    }

    public function show(Event $event, User_Sign_Up $enroll)
    {
        //$event = Event::where('id',$event_id)->first();
        return view('events.user_sign_up.show', compact('event','enroll'));
    }

    public function edit(Event $event, $enroll_id)
    {
        $enroll = User_Sign_Up::where('id', $enroll_id)->first();
        return view('events.user_sign_up.edit', compact('event','enroll'));
    }

    public function update(Event $event, User_Sign_Up $enroll, Request $request)
    {
        $enroll->number_attending = $request->number_attending;
    }
    public function destroy(Event $event, $enroll_id)
    {
        $enroll = User_Sign_Up::find($enroll_id);
        $enroll->delete();
        return redirect()->route('events.index');
    }
}
