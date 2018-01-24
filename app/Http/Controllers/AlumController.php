<?php

namespace App\Http\Controllers;

use App\Alum;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AlumController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        $alum =  Alum::where('user_id', $user_id);

        if ($alum !== null)
        {
            Session::flash('error', 'You have already created an alumni account.  Please edit your existing account.');
            return redirect()->route('home');
        }
        else
            return view('users.alumni.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, array(
            'first_name' => 'required',
            'last_name' => 'required',
            'loyal_lion' => 'required',
        ));
        //store
        $alum = new Alum;
        $alum->user_id = Auth::id();
        $alum->first_name = $request->first_name;
        $alum->last_name = $request->last_name;
        $alum->phone_number = $request->cell_phone;
        $alum->social_pref = $request->social_pref;
        $alum->street_address = $request->street;
        $alum->city = $request->city;
        $alum->state = $request->state;
        $alum->zipcode = $request->zipcode;
        $alum->loyal_lion = $request->loyal_lion;
        $alum->save();

        Session::flash('success', 'Your alumni account was successfully created!');
        return redirect()->route('users.alum.show', $alum->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alum  $alum
     * @return \Illuminate\Http\Response
     */
    public function show(Alum $alum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alum  $alum
     * @return \Illuminate\Http\Response
     */
    public function edit(Alum $alum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alum  $alum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alum $alum)
    {
        //
    }
}
