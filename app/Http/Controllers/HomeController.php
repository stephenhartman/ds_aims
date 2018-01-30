<?php

namespace App\Http\Controllers;

use App\Alumnus;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $alum =  Alumnus::where('user_id', $user->id)->get();

        if ($alum->isEmpty() && $request->user()->hasRole('alumni'))
            return view('users.alumni.create', compact('user'));
        else
        {
            $posts = Post::orderBy('updated_at', 'desc')->paginate(3);

            if ($request->user()->hasRole('admin'))
                return view('admin.home')->withPosts($posts);
            else
                return view('home')->withPosts($posts);
        }
    }
}
