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
                'photo_url' => 'mimes:jpeg,jpg,png,gif|between:0,5120'
            ));
            //store
            $alumnus = new Alumnus;
            $alumnus->user_id = $user->id;
            $alumnus->first_name = $request->first_name;
            $alumnus->last_name = $request->last_name;
            $alumnus->phone_number = $request->phone_number;
            $alumnus->street_address = $request->street_address;
            $alumnus->city = $request->city;
            $alumnus->state = $request->state;
            $alumnus->zipcode = $request->zipcode;
            $alumnus->year_graduated = $request->year_graduated;


            // Social checkboxes
            if(!$request->has('facebook'))
                $request->merge(['facebook' => 0]);
            else
                $request->merge(['facebook' => 1]);
            $alumnus->facebook = $request->facebook;

            if(!$request->has('twitter'))
                $request->merge(['twitter' => 0]);
            else
                $request->merge(['twitter' => 1]);
            $alumnus->twitter = $request->twitter;

            if(!$request->has('instagram'))
                $request->merge(['instagram' => 0]);
            else
                $request->merge(['instagram' => 1]);
            $alumnus->instagram = $request->instagram;

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

            // Save is_parent checkbox
            if(!$request->has('is_parent')) {
                $request->merge(['is_parent' => 0]);
                $alumnus->parent_name = null;
            }
            else {
                $request->merge(['is_parent' => 1]);
                $alumnus->parent_name = $request->parent_name;
            }
            $alumnus->is_parent = $request->is_parent;

            $this->upload_photo($request, $alumnus);

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
            'photo_url' => 'mimes:jpeg,jpg,png,gif|between:0,5120'
        ));

        //store
        $alumnus->first_name = $request->first_name;
        $alumnus->last_name = $request->last_name;
        $alumnus->phone_number = $request->phone_number;
        $alumnus->street_address = $request->street_address;
        $alumnus->city = $request->city;
        $alumnus->state = $request->state;
        $alumnus->zipcode = $request->zipcode;
        $alumnus->year_graduated = $request->year_graduated;

        // Social checkboxes
        if(!$request->has('facebook'))
            $request->merge(['facebook' => 0]);
        else
            $request->merge(['facebook' => 1]);
        $alumnus->facebook = $request->facebook;

        if(!$request->has('twitter'))
            $request->merge(['twitter' => 0]);
        else
            $request->merge(['twitter' => 1]);
        $alumnus->twitter = $request->twitter;

        if(!$request->has('instagram'))
            $request->merge(['instagram' => 0]);
        else
            $request->merge(['instagram' => 1]);
        $alumnus->instagram = $request->instagram;

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

        // Save is_parent checkbox
        if(!$request->has('is_parent')) {
            $request->merge(['is_parent' => 0]);
            $alumnus->parent_name = null;
        }
        else {
            $request->merge(['is_parent' => 1]);
            $alumnus->parent_name = $request->parent_name;
        }
        $alumnus->is_parent = $request->is_parent;

        $this->upload_photo($request, $alumnus);

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

    /**
     * Upload photo logic for update and store
     *
     * @param Request $request
     * @param Alumnus $alumnus
     * @return $this
     */
    public function upload_photo(Request $request, Alumnus $alumnus)
    {
        // Save photo url for profile picture
        if ($request->has('photo_url'))
        {
            File::delete(public_path($alumnus->photo_url));
            $image = $request->file('photo_url');
            $extension = $image->getClientOriginalExtension();
            if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif')
            {
                $filename = bin2hex(random_bytes(12)) . '.' . $extension;
                $img = Image::make($image);
                $file = $image->move(public_path('images/alumni'), $filename);
                $img->resize(320, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($file);
                ImageOptimizer::optimize($file);
                $alumnus->photo_url = '/images/alumni/'. $file->getFilename();
            }
            else
            {
                Session::flash('error', 'Please upload a .jpeg, .jpg, .gif or .png file');
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Delete profile photo
     *
     * @param Request $request
     * @param User $user
     * @param Alumnus $alumnus
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function photo_delete(User $user, Alumnus $alumnus)
    {
        File::delete(public_path($alumnus->photo_url));
        $alumnus->photo_url = null;

        $alumnus->save();

        session()->flash('alert', 'Profile photo was successfully deleted.');
        return redirect()->route('users.show', compact('user'));
    }
}
