<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Education;
use App\Occupation;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @param UsersDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        if (Auth::user()->hasRole('admin')) {
            return $dataTable->render('users.index');
        }
        Session::flash('error', 'You are not authorized to view this page.');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Auth::user() == $user && Auth::user()->hasRole('admin'))
            return view('admin.show', compact('user'));

        $alumnus = $user->alumnus()->first();
        $educations = Education::where('alumni_id', $alumnus->id)->get();
        $occupations = Occupation::where('alumni_id', $alumnus->id)->get();
        if (Auth::user()->hasRole('admin'))
            return view('users.show', compact('user', 'alumnus', 'educations', 'occupations'));
        elseif (Auth::user() == $user)
            return view('users.show', compact('user', 'alumnus', 'educations', 'occupations'));
        else {
            Session::flash('error', 'You are not authorized to view this page.');
            return redirect()->route('home');
        }
    }
}
