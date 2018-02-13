<?php

namespace App\Http\Controllers;

use App\Alumnus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            $alumnus->year_graduated = $request->year_graduated;

            // Save volunteer checkbox
            if(!$request->has('volunteer'))
                $request->merge(['volunteer' => 0]);
            else
                $request->merge(['volunteer' => 1]);
            $alumnus->volunteer = $request->volunteer;

            // Save photo url for profile picture
            if ($request->has('photo_url'))
            {
                $image = $request->file('photo_url');
                $extension = $image->getClientOriginalExtension();
                if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif')
                {
                    $filename = bin2hex(random_bytes(12)) . '.' . $extension;
                    $filepath = '/images/alumni/' . $filename;
                    $location = public_path($filepath);
                    $img = Image::make($image);
                    $img->resize(320, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($location);
                    ImageOptimizer::optimize($location);
                    $alumnus->photo_url = $filepath;
                }
                else
                {
                    return redirect()->back()->withInput()
                        ->withErrors(['photo_url' => 'Please choose a profile image in .jpg, .jpeg, .gif, or .png format']);
                }
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
        $alumnus->phone_number = $request->phone_number;
        $alumnus->social_pref = $request->social_pref;
        $alumnus->street_address = $request->street_address;
        $alumnus->city = $request->city;
        $alumnus->state = $request->state;
        $alumnus->zipcode = $request->zipcode;
        $alumnus->year_graduated = $request->year_graduated;

        // Save volunteer checkbox
        if(!$request->has('volunteer'))
            $request->merge(['volunteer' => 0]);
        else
            $request->merge(['volunteer' => 1]);
        $alumnus->volunteer = $request->volunteer;

        // Save photo url for profile picture
        if ($request->has('photo_url'))
        {
            File::delete(public_path($alumnus->photo_url));
            $image = $request->file('photo_url');
            $extension = $image->getClientOriginalExtension();
            if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif')
            {
                $filename = bin2hex(random_bytes(12)) . '.' . $extension;
                $filepath = '/images/alumni/' . $filename;
                $location = public_path($filepath);
                $img = Image::make($image);
                $img->resize(320, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($location);
                ImageOptimizer::optimize($location);
                $alumnus->photo_url = $filepath;
            }
            else
            {
                Session::flash('error', 'Please upload a .jpeg, .jpg, .gif or .png file');
                return redirect()->back()->withInput();
            }
        }

        $alumnus->save();

        Session::flash('success', 'Your alumni account was successfully saved!');
        return redirect()->route('users.show', compact('user'));
    }

    /**
     * Final view in account creation
     *
     * @param User $user
     * @param Alumnus $alumnus
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function community(User $user, Alumnus $alumnus)
    {
        return view('users.alumni.community', compact('user','alumnus'));
    }

    /**
     * Final POST in account creation
     *
     * @param Request $request
     * @param User $user
     * @param Alumnus $alumnus
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function final_store(Request $request, User $user, Alumnus $alumnus)
    {
        // Save volunteer checkbox
        if(!$request->has('volunteer'))
            $request->merge(['volunteer' => 0]);
        else
            $request->merge(['volunteer' => 1]);
        $alumnus->volunteer = $request->volunteer;

        // Save loyal_lion checkbox
        if(!$request->has('loyal_lion'))
            $request->merge(['loyal_lion' => 0]);
        else
            $request->merge(['loyal_lion' => 1]);
        $alumnus->loyal_lion = $request->loyal_lion;

        // Initial setup complete
        $alumnus->initial_setup = 1;

        $alumnus->save();

        Session::flash('success', 'Thank you for registering your Alumni Account!');
        return redirect('home');
    }
}
