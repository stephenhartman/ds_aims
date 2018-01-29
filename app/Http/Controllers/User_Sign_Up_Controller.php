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
    public function index()
    {

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

        $enroll->save();

        return redirect()->route('events.index');
    }

}
