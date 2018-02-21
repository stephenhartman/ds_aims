<?php

namespace App\Http\Controllers;

use App\Alumnus;
use App\User;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jrean\UserVerification\Facades\UserVerification;

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

            if ($request->user()->hasRole('admin'))
                return view('admin.home')->withPosts($posts);
            else
                return view('home')->withPosts($posts);
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
}
