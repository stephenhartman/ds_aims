<?php

namespace App\Http\Controllers;

use App\Alumnus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Purifier;
use Image;
use ImageOptimizer;

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
        $alumnus =  Alumnus::where('user_id', $user->id)->first();

        if ($alumnus == null)
            return view('users.alumni.create');
        else {
            Session::flash('error', 'You have already created an alumni account.  Please edit your existing account.');
            return view('users.alumni.edit', compact('user', 'alumnus'));
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
        $alumnus =  Alumnus::where('user_id', $user->id)->first();

        if (!$alumnus == null) {
            Session::flash('error', 'You have already created an alumni account.  Please edit your existing account.');
            return view('users.alumni.edit', compact('user', 'alumnus'));
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
            $alumnus->phone_number = $request->phone_number;
            $alumnus->social_pref = $request->social_pref;
            $alumnus->street_address = $request->street_address;
            $alumnus->city = $request->city;
            $alumnus->state = $request->state;
            $alumnus->zipcode = $request->zipcode;

            // Save volunteer checkbox
            if(!$request->has('volunteer'))
            {
                $request->merge(['volunteer' => 0]);
            }
            $alumnus->volunteer = $request->volunteer;

            // Save photo url for profile picture
            if ($request->has('photo_url'))
            {
                 $image = $request->file('photo_url');
                 $filename = bin2hex(random_bytes(12)) . '.' . $image->getClientOriginalExtension();
                 $location = public_path('/images/' . $filename);
                 $img = Image::make($image);
                 $img->resize(320, null, function ($constraint) {
                    $constraint->aspectRatio();
                 })->save($location);
                 ImageOptimizer::optimize($location);
                 $alumnus->photo_url = $filename;
            }

            $alumnus->save();

            Session::flash('success', 'Your alumni account was successfully created!');
            return redirect()->route('users.alumni.milestones.index', compact('user', 'alumnus'));
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
        if ($alumnus == null)
            $alumnus =  Alumnus::where('user_id', $user->id)->get();
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

        // Save volunteer checkbox
        if(!$request->has('volunteer'))
            $request->merge(['volunteer' => 0]);
        $alumnus->volunteer = $request->volunteer;

        // Save photo url for profile picture
        if ($request->has('photo_url'))
        {
            $image = $request->file('photo_url');
            $filename = bin2hex(random_bytes(12)) . '.' . $image->getClientOriginalExtension();
            $location = public_path('/images/' . $filename);
            $img = Image::make($image);
            $img->resize(320, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);
            ImageOptimizer::optimize($location);
            $alumnus->photo_url = $filename;
        }

        $alumnus->save();

        Session::flash('success', 'Your alumni account was successfully saved!');
        return redirect()->route('users.alum.show', compact('user','alumnus'));
    }
}
