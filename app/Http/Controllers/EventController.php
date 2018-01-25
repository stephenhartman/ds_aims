<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use \Calendar;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = [];
        $data = Event::all();
        if($data->count()){
            foreach ($data as $key => $value){
                $date = new Carbon($value->start_date);
                $dt = $date->toDateTimeString();
                $end = $date->addHour(3);
                $et = $end->toDateTimeString();
                $events[] = Calendar::event(
                    $value->name,
                    false,
                    $dt,
                    $et,
                    $value->id,
                         [
                             'description' => "This is an event",
                             'color' => $this->getColor($value->type),
                             'link' => route('events.edit', $value->id)
                         ]
                );
            }
        }

        $calendar = Calendar::addEvents($events)
            ->setCallbacks([
                'eventClick' => 'function(event, jsEvent, view) {
            $("#modalTitle").html("<strong>" + event.title + "</strong>");
            $("#modalBody").html("<strong>Start time:</strong> " + moment(event.start).format("dddd, MMMM Do YYYY, h:mm:ss a") + "<br>" + "<strong>End time:</strong> " + moment(event.end).format("dddd, MMMM Do YYYY, h:mm:ss a") + "<br>" + "<strong>Description:</strong> " + event.description);
            $("#eventUrl").attr("href", event.link);
            $("#calendarModal").modal();
                }'
            ]);
        return view('events.index', compact('calendar'));
        //$events = Event::orderBy('date')->get();

        //return view('events.index', compact('events'));
    }
    private function getColor($type){
        if ($type == "Volunteer"){
            return "blue";
        }else if($type == "Reunion"){
            return "red";
        }else
            return "green";

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event;
        $event->name = $request->event_name;
        $event->type = $request->event_type;
        $event->date = $request->event_date;
        $event->time = $request->event_time;

        $event->save();

        return redirect()->route('events.show', $event);
    }

    /**
     * Display the specified resource.
     *
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Event $event)
    {
        $event->name = $request->event_name;
        $event->type = $request->event_type;
        $event->date = $request->event_date;
        $event->time = $request->event_time;
        $event->save();

        // set flash data with success message
        Session::flash('success', 'The event was successfully saved.');

        return redirect()->route('events.show', $event->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index');
    }
}
