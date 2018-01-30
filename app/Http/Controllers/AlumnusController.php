<?php

namespace App\Http\Controllers;

use App\Alumnus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AlumnusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $alum =  Alumnus::where('user_id', $user->id)->get();

        if ($alum->isEmpty())
            return view('users.alumni.create');
        else {
            Session::flash('error', 'You have already created an alumni account.  Please edit your existing account.');
            return view('users.alumni.edit', compact('user', 'alum'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $alum =  Alumnus::where('user_id', $user->id)->get();

        if (!$alum->isEmpty()) {
            Session::flash('error', 'You have already created an alumni account.  Please edit your existing account.');
            return view('users.alumni.edit', compact('user', 'alum'));
        }
        else {

            //validate
            $this->validate($request, array(
                'first_name' => 'required',
                'last_name' => 'required',
            ));
            //store
            $alumnus = new Alumnus;
            $alumnus->user_id = $user->id;
            $alumnus->first_name = $request->first_name;
            $alumnus->last_name = $request->last_name;
            $alumnus->phone_number = $request->cell_phone;
            $alumnus->social_pref = $request->social_pref;
            $alumnus->street_address = $request->street;
            $alumnus->city = $request->city;
            $alumnus->state = $request->state;
            $alumnus->zipcode = $request->zipcode;
            $alumnus->loyal_lion = $request->loyal_lion;
            $alumnus->save();

            Session::flash('success', 'Your alumni account was successfully created!');
            return redirect()->route('users.alumni.show', compact('user', 'alumnus'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param  \App\Alumnus  $alumnus
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Alumnus $alumnus)
    {
        return view('users.alumni.show', compact('user', 'alumnus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @param  \App\Alumnus  $alumnus
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Alumnus $alumnus)
    {
        return view('users.alumni.edit', compact('user', 'alumnus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User $user
     * @param  \App\Alumnus  $alumnus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user,  Alumnus $alumnus)
    {
        //validate
        $this->validate($request, array(
            'first_name' => 'required',
            'last_name' => 'required',
            'loyal_lion' => 'required',
        ));

        //store
        $alumnus->first_name = $request->first_name;
        $alumnus->last_name = $request->last_name;
        $alumnus->phone_number = $request->cell_phone;
        $alumnus->social_pref = $request->social_pref;
        $alumnus->street_address = $request->street;
        $alumnus->city = $request->city;
        $alumnus->state = $request->state;
        $alumnus->zipcode = $request->zipcode;
        $alumnus->loyal_lion = $request->loyal_lion;
        $alumnus->save();

        Session::flash('success', 'Your alumni account was successfully saved!');
        return redirect()->route('users.alum.show', compact('user','alumnus'));
    }
}
