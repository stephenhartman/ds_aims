<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

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
		$posts = Post::orderBy('id', 'desc')->paginate(3);
    	
        if ($request->user()->hasRole('admin'))
            return view('admin.home')->withPosts($posts);
        else
            return view('home')->withPosts($posts);
    }
}
