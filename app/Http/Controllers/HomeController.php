<?php

namespace App\Http\Controllers;

use App\Alumnus;
use App\User;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jrean\UserVerification\Facades\UserVerification;
use App\Event;
use App\EventChild;
use App\EventSignUp;
use App\EventSignUpChild;
use Carbon\Carbon;
use \Calendar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $alumnus =  Alumnus::where('user_id', $user->id)->get();

        if ($alumnus->isEmpty() && $request->user()->hasRole('alumni'))
            return view('users.alumni.create', compact('user'));
        else
        {
            $posts = Post::orderBy('id', 'desc')->paginate(3);

            $events = [];
            $data = Event::all();
            $data2 = EventChild::all();

            //create js events for Events
            if($data->count()) {
                foreach ($data as $key => $value) {
                    $start_date = new Carbon($value->start_date);
                    $sd = $start_date->toDateTimeString();
                    $end_date = new Carbon($value->end_date);
                    $ed = $end_date->toDateTimeString();
                    $exists = $this->signUp_exists($value->id);

                    //if user is not signed up
                    if ($exists == 0) {
                        $events[] = Calendar::event(
                            $value->title,
                            false,
                            $sd,
                            $ed,
                            $value->id,
                            [
                                'location' => $value->location,
                                'location_url' => $value->location_url,
                                'description' => $value->description,
                                'color' => $this->getColor($value->type, $exists),
                                'link' => route('events.edit', $value->id),
                                'sign_up' => route('events.event_sign_ups.create', $value->id),
                                'button' => 'Sign up for an event',
                                'enroll_index' => route('events.event_sign_ups.index', $value->id),
                                'child' => '0'
                            ]
                        );
                        //if user is signed up
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
                                'location' => $value->location,
                                'location_url' => $value->location_url,
                                'description' => $value->description,
                                'color' => $this->getColor($value->type, $exists),
                                'link' => route('events.edit', $value->id),
                                'sign_up' => route('events.event_sign_ups.edit', compact('event_id', 'enroll_id')),
                                'button' => 'Unenroll or Edit',
                                'enroll_index' => route('events.event_sign_ups.index', $value->id),
                                'child' => '0'
                            ]
                        );
                    }
                }
            }

            //create js events for EventChilds
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

                    //if user is signed up
                    if($exists == 0)
                    {
                        $events[] = Calendar::event(
                            $parent->title,
                            false,
                            $sd,
                            $ed,
                            $value->id,
                            [
                                'location' => $parent->location,
                                'location_url' => $parent->location_url,
                                'description' => $parent->description,
                                'color' => $this->getColor($parent->type, $exists),
                                'link' => route('events.event_child.edit', compact('parent_id', 'child_id')),
                                'sign_up' => route('events.event_child.sign_ups.create', [$parent->id, $value->id]),
                                'button' => 'Sign up for an event',
                                'enroll_index' => route('events.event_child.sign_ups.index', [$parent->id, $value->id]),
                                'child' => '1',
                                'updates' => $value->updates
                            ]
                        );
                        //if user is not signed up
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
                                'location' => $parent->location,
                                'location_url' => $parent->location_url,
                                'description' => $parent->description,
                                'color' => $this->getColor($parent->type, $exists),
                                'link' => route('events.event_child.edit', compact('parent_id', 'child_id')),
                                'sign_up' => route('events.event_child.sign_ups.edit', compact('parent_id', 'child_id','enroll_id')),
                                'button' => 'Unenroll or Edit',
                                'enroll_index' => route('events.event_child.sign_ups.index', [$parent->id, $value->id]),
                                'child' => '1',
                                'updates' => $value->updates
                            ]
                        );
                    }
                }
            }
            $calendar = Calendar::addEvents($events)
                ->setOptions([
                    'defaultView' => 'listMonth',
                    'header' => ['left'=> 'prev,next today', 'center' => 'title', 'right' => 'listMonth, month, agendaWeek'],
                    'fixedWeekCount' => false,
                    'scrollTime' => '09:00:00',
                    'themeSystem' => 'bootstrap3',
                    'cursor' => 'pointer'
                ])
                ->setCallbacks([
                    'eventClick' => 'function(event, jsEvent, view) {
                                $("#modalTitle").html("<strong>" + event.title + "</strong>");
                                if (event.child == 1){
                                    if(event.updates != null){
                                        $("#modalBody").html("<strong>Start time:</strong> " + moment(event.start).format("dddd, MMMM Do YYYY, h:mm a") + "<br>" + "<strong>End time:</strong> " + moment(event.end).format("dddd, MMMM Do YYYY, h:mm a") + "<br>" + "<strong>Location:</strong> " + event.location + "<br>" + "<strong>Description:</strong> " + event.description + "<br>" + "<strong>Updates:</strong> " + event.updates);
                                    }else{
                                        $("#modalBody").html("<strong>Start time:</strong> " + moment(event.start).format("dddd, MMMM Do YYYY, h:mm a") + "<br>" + "<strong>End time:</strong> " + moment(event.end).format("dddd, MMMM Do YYYY, h:mm a") + "<br>" + "<strong>Location:</strong> " + event.location + "<br>" + "<strong>Description:</strong> " + event.description);
                                    }
                                }else{
                                    $("#modalBody").html("<strong>Start time:</strong> " + moment(event.start).format("dddd, MMMM Do YYYY, h:mm a") + "<br>" + "<strong>End time:</strong> " + moment(event.end).format("dddd, MMMM Do YYYY, h:mm a") + "<br>" + "<strong>Location:</strong> " + event.location + "<br>" + "<strong>Description:</strong> " + event.description);
                                }
                                $("#location").attr("href", event.location_url).html("Event location");
                                $("#eventUrl").attr("href", event.link).html("Edit this event");
                                $("#index").attr("href", event.enroll_index).html("View enrollment");
                                if (moment().format("YYYYMMDD") <= moment(event.start).format("YYYYMMDD"))
                                    $("#sign_up").attr("href", event.sign_up).html(event.button).show();
                                else
                                    $("#sign_up").hide();
                                $("#delete").attr("href", event.delete).html(event.delete_btn);
                                $("#calendarModal").modal();
                                }'
                ]);

            return view('home', compact('posts', 'calendar'));
        }
    }

    /**
     * Resend verification token
     *
     * @param $id user id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resendVerification($id)
    {
        $user = User::find($id);
        UserVerification::generate($user);
        UserVerification::send($user, 'Please verify to complete registration at the DePaul Alumni Outreach System.', 'no-reply@depaulalumni.com');
        Session::flash('message', 'You will receive your verification email shortly.');
        return view('auth.errors.not-verified');
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
            $flag = 1;
        else
            $flag = 0;
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
            $flag = 1;
        else
            $flag = 0;
        return $flag;
    }

    private function get_child_sign_up($parent_id, $child_id)
    {
        $user_id = Auth::id();
        $enroll = EventSignUpChild::where('user_id', $user_id)->where('event_id', $parent_id)->where('child_id', $child_id)->first();

        return $enroll;
    }
}
