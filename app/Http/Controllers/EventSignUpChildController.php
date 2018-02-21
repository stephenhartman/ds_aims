<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\EventChild;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use \Calendar;
use Auth;
use App\EventSignUp;
use App\EventSignUpChild;

class EventSignUpChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event, $child_id)
    {
        $volunteers = EventSignUpChild::where('event_id', $event->id)->where('child_id', $child_id)->get();
        return view('events.event_child.sign_ups.index', compact('event', 'child', 'volunteers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event, $child_id)
    {
        $user = Auth::user()->id;

        $child = EventChild::find($child_id);

        $start_date = new Carbon($child->start_date);
        $sd = $start_date->toDateString();
        $st = $start_date->format('h:i A');
        $end_date = new Carbon($child->end_date);
        $et = $end_date->format('h:i A');

        return view('events.event_child.sign_ups.create', compact('user', 'event', 'sd', 'st', 'et', 'child'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enroll = new EventSignUpChild;
        $enroll->user_id = $request->user_id;
        $enroll->event_id = $request->event_id;
        $enroll->child_id = $request->child_id;
        $enroll->number_attending = $request->number_attending;
        $enroll->notes = $request->notes;


        $enroll->save();

        Session::flash('success', 'You have been signed up!.');
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, $child_id, $enroll_id)
    {
        $user = Auth::user()->id;
        $child = EventChild::find($child_id);
        $enroll = EventSignUpChild::where('id', $enroll_id)->first();

        $start_date = new Carbon($child->start_date);
        $sd = $start_date->toDateString();
        $st = $start_date->format('h:i A');
        $end_date = new Carbon($child->end_date);
        $et = $end_date->format('h:i A');

        return view('events.event_child.sign_ups.edit', compact('event', 'child', 'enroll', 'user', 'sd', 'st', 'et'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($event_id, $child_id, $enroll_id, Request $request)
    {

        $enroll = EventSignUpChild::where('id', $enroll_id)->first();
        $enroll->user_id = $request->user_id;
        $enroll->event_id = $request->event_id;
        $enroll->child_id = $request->child_id;
        $enroll->number_attending = $request->number_attending;
        $enroll->notes = $request->notes;

        $enroll->save();

        Session::flash('success', 'You have been signed up!');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, $child_id, $enroll_id)
    {
        $enroll = EventSignUpChild::where('id', $enroll_id)->first();
        $enroll->delete();

        Session::flash('success', 'You have been unenrolled!');
        return redirect()->route('events.index');
    }
}