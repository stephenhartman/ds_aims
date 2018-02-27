<?php

namespace App\Http\Controllers;

use App\EventChild;
use App\EventSignUpChild;
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
        $data2 = EventChild::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $start_date = new Carbon($value->start_date);
                $sd = $start_date->toDateTimeString();
                $end_date = new Carbon($value->end_date);
                $ed = $end_date->toDateTimeString();
                $exists = $this->signUp_exists($value->id);
                if ($exists == 0) {
                    $events[] = Calendar::event(
                        $value->title,
                        false,
                        $sd,
                        $ed,
                        $value->id,
                        [
                            'description' => $value->description,
                            'color' => $this->getColor($value->type, $exists),
                            'link' => route('events.edit', $value->id),
                            'sign_up' => route('events.event_sign_ups.create', $value->id),
                            'button' => 'Sign up for an event',
                            'enroll_index' => route('events.event_sign_ups.index', $value->id),
                        ]
                    );
                }else
                {
                    $enroll = $this->getSignUp($value->id);
                    $enroll_id = $enroll->id;
                    $event_id = $value->id;

                    $events[] = Calendar::event(
                        $value->title,
                        false,
                        $sd,
                        $ed,
                        $value->id,
                        [
                            'description' => $value->description,
                            'color' => $this->getColor($value->type, $exists),
                            'link' => route('events.edit', $value->id),
                            'sign_up' => route('events.event_sign_ups.edit', compact('event_id', 'enroll_id')),
                            'button' => 'Unenroll or Edit',
                            'enroll_index' => route('events.event_sign_ups.index', $value->id),

                        ]
                    );
                }
            }
        }
        if($data2->count()){
            foreach ($data2 as $key => $value) {
                $parent = Event::withTrashed()->where('id', $value->parent_id)->first();
                $parent_id = $parent->id;
                $child_id = $value->id;
                $start_date = new Carbon($value->start_date);
                $sd = $start_date->toDateTimeString();
                $end_date = new Carbon($value->end_date);
                $ed = $end_date->toDateTimeString();
                $exists = $this->child_sign_up_exists($parent_id ,$value->id);
                if($exists == 0)
                {
                    $events[] = Calendar::event(
                        $parent->title,
                        false,
                        $sd,
                        $ed,
                        $value->id,
                        [
                            'description' => $parent->description . "<br>" .  "<strong> Updates</strong>:  " . $value->updates,
                            'color' => $this->getColor($parent->type, $exists),
                            'link' => route('events.event_child.edit', compact('parent_id', 'child_id')),
                            'sign_up' => route('events.event_child.sign_ups.create', [$parent->id, $value->id]),
                            'button' => 'Sign up for an event',
                            'enroll_index' => route('events.event_child.sign_ups.index', [$parent->id, $value->id]),
                        ]
                    );
                }else
                {
                    $enroll = $this->get_child_sign_up($parent_id, $value->id);
                    $enroll_id = $enroll->id;

                    $events[] = Calendar::event(
                        $parent->title,
                        false,
                        $sd,
                        $ed,
                        $value->id,
                        [
                            'description' => $parent->description . "<br>" .  "<strong> Updates</strong>:  " . $value->updates,
                            'color' => $this->getColor($parent->type, $exists),
                            'link' => route('events.event_child.edit', compact('parent_id', 'child_id')),
                            'sign_up' => route('events.event_child.sign_ups.edit', compact('parent_id', 'child_id','enroll_id')),
                            'button' => 'Unenroll or Edit',
                            'enroll_index' => route('events.event_child.sign_ups.index', [$parent->id, $value->id]),

                        ]
                    );

                }

            }

        }
        $calendar = Calendar::addEvents($events)
            ->setOptions([
                'header' => ['left'=> 'prev,next today', 'center' => 'title', 'right' => 'month, agendaWeek, agendaDay'],
                'fixedWeekCount' => false,
                'scrollTime' => '07:00:00'
            ])
            ->setCallbacks([
                'eventClick' => 'function(event, jsEvent, view) {
                                $("#modalTitle").html("<strong>" + event.title + "</strong>");
                                $("#modalBody").html("<strong>Start time:</strong> " + moment(event.start).format("dddd, MMMM Do YYYY, h:mm a") + "<br>" + "<strong>End time:</strong> " + moment(event.end).format("dddd, MMMM Do YYYY, h:mm a") + "<br>" + "<strong>Description:</strong> " + event.description);
                                $("#eventUrl").attr("href", event.link).html("Edit this event");
                                $("#index").attr("href", event.enroll_index).html("View enrollment");
                                $("#sign_up").attr("href", event.sign_up).html(event.button);
                                $("#delete").attr("href", event.delete).html(event.delete_btn);
                                $("#calendarModal").modal();
                                }',
                'dayClick' => 'function(date, jsEvent, view){
                    $("#newEventTitle").html("<strong>" + date.format("dddd, MMMM Do YYYY") + "</strong>");
                    $("#newModalDate").attr("value", date.format("YYYY/MM/DD"));
                    $("#newEventModal").modal();
                }'
            ]);
        return view('events.index', compact('calendar'));
    }

    private function getColor($type, $exists)
    {
        if($exists == 1)
        {
            return '#009900';
        }else
        {
            if ($type == "Volunteer"){
                return "#ff7f00";
            }else if($type == "Reunion"){
                return "#053D63";
            }else
                return "#7f3f00";
        }


    }
    private function signUp_exists($id)
    {
        $user_id = Auth::id();
        if(EventSignUp::where('user_id', $user_id)->where('event_id', $id)->exists())
        {
            $flag = 1;
        }else
        {
            $flag = 0;
        }
        return $flag;
    }
    private function getSignUp($id)
    {
        $user_id = Auth::id();
        $enroll = EventSignUp::where('user_id', $user_id)->where('event_id', $id)->first();

        return $enroll;

    }

    private function child_sign_up_exists($parent_id, $child_id)
    {
        $user_id = Auth::id();
        if(EventSignUpChild::where('user_id', $user_id)->where('event_id', $parent_id)->where('child_id', $child_id)->exists())
        {
            $flag = 1;
        }else
        {
            $flag = 0;
        }
        return $flag;
    }

    private function get_child_sign_up($parent_id, $child_id)
    {
        $user_id = Auth::id();
        $enroll = EventSignUpChild::where('user_id', $user_id)->where('event_id', $parent_id)->where('child_id', $child_id)->first();

        return $enroll;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(isset($request->date)){
            $date = strtotime($request->date);
        }else{
            $date = Carbon::now()->timestamp;
        }

        return view('events.create',compact('date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->repeats == 0){
            $this->validate($request,[
                'event_title' => 'required',
                'event_type' => 'required',
                'event_start_date' => 'required|date_format:Y-m-d',
                'event_start_time' => 'required|date_format:H:i',
                'event_end_time' => 'required|date_format:H:i|after:event_start_time',
                'event_description' => 'required'

            ]);
            $event = new Event;
            $event->title = $request->event_title;
            $event->type = $request->event_type;
            $event->start_date = $request->event_start_date . " " . $request->event_start_time;
            $event->end_date  = $request->event_start_date . " " . $request->event_end_time;
            $event->description = $request->event_description;
            $event->repeats = 0;
            $event->repeat_freq = 0;
            $event->repeat_until = $request->event_start_date . " " . $request->event_end_time;
            $event->save();

            return redirect()->route('events.index');
        }else{
            $this->validate($request,[
                'event_title' => 'required',
                'event_type' => 'required',
                'event_start_date' => 'required|date_format:Y-m-d',
                'event_start_time' => 'required|date_format:H:i',
                'event_end_time' => 'required|date_format:H:i|after:event_start_time',
                'event_description' => 'required',
                'repeat_freq' => 'required',
                'repeat_until' => 'required|date_format:Y-m-d|after:event_start_date'
            ]);

            $repeats = $request->repeats;
            $repeat_freq = $request->repeat_freq;
            $repeat_until = new Carbon($request->repeat_until);
            $date_holder = new Carbon($request->event_start_date);



            $event = new Event;
            $event->title = $request->event_title;
            $event->type = $request->event_type;
            $event->start_date = $request->event_start_date . " " . $request->event_start_time;
            $event->end_date  = $request->event_start_date . " " . $request->event_end_time;
            $event->description = $request->event_description;
            $event->repeats = $request->repeats;
            $event->repeat_freq = $request->repeat_freq;
            $event->repeat_until = $request->repeat_until;
            $event->save();

            $parent_id = $event->id;

            while($date_holder->lt($repeat_until))
            {
                if($repeat_freq == 0){
                    $date_holder->addDay();
                }elseif ($repeat_freq == 1){
                    $date_holder->addWeek();
                }elseif ($repeat_freq == 2){
                    $date_holder->addWeeks(2);
                }else{
                    $date_holder->addMonth();
                }
                $date_holder_clone = $date_holder;
                $date_holder_format = $date_holder_clone->format('Y-m-d');
                $event_child = new EventChild;
                $event_child->parent_id = $parent_id;
                $event_child->start_date = $date_holder_format . " " . $request->event_start_time;
                $event_child->end_date = $date_holder_format . " " . $request->event_end_time;
                $event_child->save();
            }

            Session::flash('success', 'The event was successfully saved.');

            return redirect()->route('events.index');
        }
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
        $st = $start_date->format('H:i');
        $end_date = new Carbon($event->end_date);
        $ed = $end_date->toDateString();
        $et = $end_date->format('H:i');

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
        $id = $event->id;
        if($request->all_events == 0){
            $this->validate($request,[
                'event_title' => 'required',
                'event_type' => 'required',
                'event_start_date' => 'required|date_format:Y-m-d',
                'event_start_time' => 'required|date_format:H:i',
                'event_end_time' => 'required|date_format:H:i|after:event_start_time',
                'event_description' => 'required'
            ]);

            $event->title = $request->event_title;
            $event->type = $request->event_type;
            $event->start_date = $request->event_start_date . " " . $request->event_start_time;
            $event->end_date  = $request->event_start_date . " " . $request->event_end_time;
            $event->description = $request->event_description;
            $event->save();
        }else{

            $this->validate($request,[
                'event_title' => 'required',
                'event_type' => 'required',
                'event_start_date' => 'required|date_format:Y-m-d',
                'event_start_time' => 'required|date_format:H:i',
                'event_end_time' => 'required|date_format:H:i|after:event_start_time',
                'event_description' => 'required'
            ]);

            $event->title = $request->event_title;
            $event->type = $request->event_type;
            $event->start_date = $request->event_start_date . " " . $request->event_start_time;
            $event->end_date  = $request->event_start_date . " " . $request->event_end_time;
            $event->description = $request->event_description;
            $event->save();

            $children = EventChild::where('parent_id', $id)->get();
            foreach($children as $child){
                $child_start_date = new Carbon($child->start_date);
                $event_start_date = new Carbon($request->start_date);

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
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Event $event)
    {
        $id = $event->id;
        if($request->delete_all == 0){
            $event->delete();
        }else{
            $children = EventChild::where('parent_id', $id)->get();
            foreach($children as $child) {
                $child->delete();
            }
            $event->delete();
        }

        Session::flash('success', 'The event was successfully deleted.');
        return redirect()->route('events.index');
    }
}
