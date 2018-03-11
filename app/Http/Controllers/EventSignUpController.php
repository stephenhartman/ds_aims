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
use Yajra\DataTables\DataTables;
use Html;

class EventSignUpController extends Controller
{
    public function index(Event $event)
    {
        return view('events.event_sign_ups.index', compact('event'));
    }


    public function create(Event $event)
    {
        $user = Auth::user()->id;

        $start_date = new Carbon($event->start_date);
        $sd = $start_date->toDateString();
        $st = $start_date->format('h:i A');
        $end_date = new Carbon($event->end_date);
        $et = $end_date->format('h:i A');

        return view('events.event_sign_ups.create', compact('user', 'event', 'sd', 'st', 'et'));
    }

    public function store(Request $request)
    {

        $event = Event::find($request->event_id);
        $start_date = new Carbon($event->start_date);
        $sd = $start_date->toDateString();
        $today = Carbon::now()->toDateString();

        if ($sd < $today){
            Session::flash('success', "You can't sign up for an event that's already over");
            return redirect()->route('events.index');
        }else{
            $enroll = new EventSignUp;
            $enroll->user_id = $request->user_id;
            $enroll->event_id = $request->event_id;
            $enroll->number_attending = $request->number_attending;
            $enroll->notes = $request->notes;


            $enroll->save();

            Session::flash('success', 'You have been signed up!');
            return redirect()->route('events.index');
        }


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

        $start_date = new Carbon($event->start_date);
        $sd = $start_date->toDateString();
        $st = $start_date->format('h:i A');
        $end_date = new Carbon($event->end_date);
        $et = $end_date->format('h:i A');
        return view('events.event_sign_ups.edit', compact('event','enroll', 'user', 'sd', 'st', 'et'));
    }

    public function update(Event $event, $enroll_id, Request $request)
    {
        $enroll = EventSignUp::where('id', $enroll_id)->first();
        $enroll->user_id = $request->user_id;
        $enroll->event_id = $request->event_id;
        $enroll->number_attending = $request->number_attending;
        $notes = $enroll->notes;
        $enroll->notes = $request->notes;

        $enroll->save();

        Session::flash('success', 'You have been signed up!');
        return redirect()->route('events.index');
    }
    public function destroy(Event $event, $enroll_id)
    {
        $enroll = EventSignUp::where('id', $enroll_id)->first();
        $enroll->delete();

        Session::flash('success', 'You have been unenrolled!');
        return redirect()->route('events.index');
    }

    public function event_sign_ups_data(Event $event)
    {
        $volunteers = DB::table('event_sign_ups')
            ->join('users', 'event_sign_ups.user_id', '=', 'users.id' )
            ->where('event_sign_ups.event_id', $event->id)
            ->where('event_sign_ups.deleted_at', null)
            ->select(['users.id','users.name','users.email', 'event_sign_ups.number_attending', 'event_sign_ups.notes']);

        return Datatables::of($volunteers)
            ->editColumn('name', function ($model){
                return Html::linkAction('UserController@show', $model->name, $model->id);
            })
            ->editColumn('email', function ($model) {
                return Html::mailto($model->email);
            })
            ->rawColumns(['name', 'email'])
            ->make();
    }
}
