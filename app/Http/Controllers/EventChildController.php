<?php

namespace App\Http\Controllers;

use App\EventChild;
use App\User;
use App\EventSignUp;
use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use \Calendar;
use Auth;

class EventChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventChild  $eventChild
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, EventChild $event_child)
    {
        return view('events.event_child.show', compact('event','event_child'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventChild  $eventChild
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, EventChild $event_child)
    {
        $start_date = new Carbon($event_child->start_date);
        $sd = $start_date->toDateString();
        $st = $start_date->toTimeString();
        $end_date = new Carbon($event_child->end_date);
        $ed = $end_date->toDateString();
        $et = $end_date->toTimeString();


        return view('events.event_child.edit', compact('event', 'event_child', 'sd', 'st', 'ed', 'et'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventChild  $eventChild
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event, EventChild $event_child)
    {
        $event_child->start_date = $request->event_start_date . " " . $request->event_start_time;
        $event_child->end_date  = $request->event_end_date . " " . $request->event_end_time;
        $event_child->updates = $request->updates;
        $event_child->save();

        // set flash data with success message
        Session::flash('success', 'The event was successfully saved.');

        return redirect()->route('events.event_child.show', [$event, $event_child]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventChild  $eventChild
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, EventChild $event_child)
    {
        $event_child->delete();
        return redirect()->route('events.index');

    }
}
