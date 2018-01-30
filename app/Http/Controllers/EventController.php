<?php

namespace App\Http\Controllers;

use App\User;
use App\User_Sign_Up;
use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use \Calendar;
use Auth;


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
                $start_date = new Carbon($value->start_date);
                $sd = $start_date->toDateTimeString();
                $end_date = new Carbon($value->end_date);
                $ed = $end_date->toDateTimeString();
                $exists = $this->signUp_exists($value->id);
                if($exists == 0){
                    $events[] = Calendar::event(
                        $value->name,
                        false,
                        $sd,
                        $ed,
                        $value->id,
                        [
                            'description' => $value->description,
                            'color' => $this->getColor($value->type),
                            'link' => route('events.edit', $value->id),
                            'sign_up' => route('events.user_sign_up.create', $value->id),
                            //'sign_down' => ''
                        ]
                    );
                }else {

                    $enroll = $this->getSignUp($value->id);

                    $events[] = Calendar::event(
                        $value->name . " YOU ARE SIGNED UP",
                        false,
                        $sd,
                        $ed,
                        $value->id,
                        [
                            'description' => $value->description,
                            'color' => $this->getColor($value->type),
                            'link' => route('events.edit', $value->id),
                            'sign_down' => route('events.user_sign_up.edit', [$value->id, $enroll->id])
                        ]
                    );

                }


                }
            }
        $calendar = Calendar::addEvents($events)
            ->setOptions([
                'fixedWeekCount' => false
            ])
            ->setCallbacks([
                'eventClick' => 'function(event, jsEvent, view) {
                                $("#modalTitle").html("<strong>" + event.title + "</strong>");
                                $("#modalBody").html("<strong>Start time:</strong> " + moment(event.start).format("dddd, MMMM Do YYYY, h:mm:ss a") + "<br>" + "<strong>End time:</strong> " + moment(event.end).format("dddd, MMMM Do YYYY, h:mm:ss a") + "<br>" + "<strong>Description:</strong> " + event.description);
                                $("#eventUrl").attr("href", event.link);
                                $("#sign_up").attr("href", event.sign_up);
                                $("#sign_down").attr("href", event.sign_down);
                                $("#calendarModal").modal();
                                }'
            ]);
        return view('events.index', compact('calendar', 'exists'));
        /**
        $calendar = Calendar::addEvents($events)
            ->setOptions([
                'fixedWeekCount' => false
            ])
            ->setCallbacks([
                'eventClick' => 'function(event, jsEvent, view) {
            $("#modalTitle").html("<strong>" + event.title + "</strong>");
            $("#modalBody").html("<strong>Start time:</strong> " + moment(event.start).format("dddd, MMMM Do YYYY, h:mm:ss a") + "<br>" + "<strong>End time:</strong> " + moment(event.end).format("dddd, MMMM Do YYYY, h:mm:ss a") + "<br>" + "<strong>Description:</strong> " + event.description);
            $("#eventUrl").attr("href", event.link);
            $("#sign_up").attr("href", event.sign_up);
            $("#sign_down").attr("href", event.sign_down);
            $("#calendarModal").modal();
                }'
            ]);
        return view('events.index', compact('calendar'));
        **/
        //$events = Event::orderBy('date')->get();

        //return view('events.index', compact('events'));
    }

    private function getColor($type)
    {
        if ($type == "Volunteer"){
            return "#0000FF";
        }else if($type == "Reunion"){
            return "#FF0000";
        }else
            return "#008000";

    }
    private function signUp_exists($id)
    {
        $user_id = Auth::id();
        if(User_Sign_Up::where('user_id', $user_id)->where('event_id', $id)->exists())
        {
            $flag = 1;
        }else{
            $flag = 0;
        }
        return $flag;
    }
    private function getSignUp($id)
    {
        $user_id = Auth::id();
        $enroll = User_Sign_Up::where('user_id', $user_id)->where('event_id', $id)->first();

            return $enroll;

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
        $event->start_date = $request->event_start_date . " " . $request->event_start_time;
        $event->end_date  = $request->event_end_date . " " . $request->event_end_time;
        $event->description = $request->event_description;

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
        $start_date = new Carbon($event->start_date);
        $sd = $start_date->toDateString();
        $st = $start_date->toTimeString();
        $end_date = new Carbon($event->end_time);
        $ed = $end_date->toDateString();
        $et = $end_date->toTimeString();


        return view('events.edit', compact('event', 'sd', 'st', 'ed', 'et'));
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
        $event->start_date = $request->event_start_date . " " . $request->event_start_time;
        $event->end_date  = $request->event_end_date . " " . $request->event_end_time;
        $event->description = $request->event_description;
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
