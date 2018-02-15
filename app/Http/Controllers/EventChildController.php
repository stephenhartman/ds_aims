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
    public function edit($event_id, EventChild $event_child)
    {
        $event = Event::withTrashed()->where('id', $event_id)->first();
        $start_date = new Carbon($event_child->start_date);
        $sd = $start_date->toDateString();
        $st = $start_date->format('H:i');
        $end_date = new Carbon($event_child->end_date);
        $ed = $end_date->toDateString();
        $et = $end_date->format('H:i');


        return view('events.event_child.edit', compact('event', 'event_child', 'sd', 'st', 'ed', 'et'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventChild  $eventChild
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $parent_id, EventChild $event_child)
    {

        if($request->all_events == 0){

            $this->validate($request, [
                'event_start_date' => 'required|date_format:Y-m-d',
                'event_start_time' => 'required|date_format:H:i',
                'event_end_time' => 'required|date_format:H:i|after:event_start_time'
            ]);

            $event_child->start_date = $request->event_start_date . " " . $request->event_start_time;
            $event_child->end_date  = $request->event_start_date . " " . $request->event_end_time;
            $event_child->updates = $request->updates;
            $event_child->save();
        }else{

            $this->validate($request,[
                'event_title' => 'required',
                'event_type' => 'required',
                'event_start_date' => 'required|date_format:Y-m-d',
                'event_start_time' => 'required|date_format:H:i',
                'event_end_time' => 'required|date_format:H:i|after:event_start_time',
                'event_description' => 'required'
            ]);

            $event = Event::withTrashed()->where('id', $parent_id)->first();
            $children = EventChild::where('parent_id', $parent_id)->get();

            $event_date = new Carbon($event->start_date);
            $ed = $event_date->toDateString();

            $event->title = $request->event_title;
            $event->type = $request->event_type;
            $event->start_date = $ed . " " . $request->event_start_time;
            $event->end_date = $ed . " " . $request->event_end_date;
            $event->description = $request->event_description;
            $event->save();
            foreach($children as $child){
                $child_start_date = new Carbon($child->start_date);
                $csd = $child_start_date->toDateString();
                $child->start_date = $csd . " " . $request->event_start_time;
                $child->end_date  = $csd . " " . $request->event_end_time;
                $child->updates = $request->updates;
                $child->save();
            }
        }

        // set flash data with success message
        Session::flash('success', 'The event was successfully saved.');

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventChild  $eventChild
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $parent_id, EventChild $event_child)
    {
        $parent = Event::withTrashed()->where('id', $parent_id)->first();
        if($request->delete_all == 0){
            $event_child->delete();
        }else{
            $children = EventChild::where('parent_id', $parent_id)->get();
            foreach($children as $child){
                $child->delete();
            }
            $parent->delete();
        }
        return redirect()->route('events.index');
    }
}
