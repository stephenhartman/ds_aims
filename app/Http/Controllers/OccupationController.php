<?php

namespace App\Http\Controllers;

use App\User;
use App\Occupation;
use App\Alumnus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Purifier;

class OccupationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @param  \App\Alumnus  $alumnus
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Alumnus $alumnus)
    {
        return view('users.alumni.occupation.create', compact('user','alumnus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User @user
     * @param  \App\Alumnus  $alumnus
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Alumnus $alumnus)
    {
        $this->validate($request, array(
            'organization' => 'required',
            'position' => 'required',
            'start_year' => 'required|size:4'
        ));

        $occupation = new Occupation();

        $occupation->alumnus_id = $alumnus->id;
        $occupation->organization = $request->organization;
        $occupation->position = $request->position;
        $occupation->start_year = $request->start_year;
        $occupation->end_year = $request->end_year;
        $occupation->type = $request->type;
        $occupation->testimonial = Purifier::clean($request->testimonial);

        // Save share checkbox
        if(!$request->has('share'))
            $request->merge(['share' => 0]);
        else
            $request->merge(['share' => 1]);
        $occupation->share = $request->share;

        $occupation->save();

        Session::flash('success', 'The occupation milestone was successfully created!');
        $setup = $alumnus->initial_setup;
        if ($setup == 0)
            return redirect()->route('users.alumni.milestones.index', compact('user', 'alumnus'));
        elseif ($setup == 1)
            return redirect()->route('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @param  \App\Alumnus  $alumnus
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Alumnus $alumnus, Occupation $occupation)
    {
        return view('users.alumni.occupation.edit', compact('user', 'alumnus', 'occupation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumnus  $alumnus
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Alumnus $alumnus, Occupation $occupation)
    {
        $this->validate($request, array(
            'organization' => 'required',
            'position' => 'required',
            'start_year' => 'required'
        ));

        $occupation->organization = $request->organization;
        $occupation->position = $request->position;
        $occupation->start_year = $request->start_year;
        $occupation->end_year = $request->end_year;
        $occupation->type = $request->type;
        $occupation->testimonial = Purifier::clean($request->testimonial);

        // Save share checkbox
        if(!$request->has('share'))
            $request->merge(['share' => 0]);
        else
            $request->merge(['share' => 1]);
        $occupation->share = $request->share;

        $occupation->save();

        Session::flash('success', 'The occupation milestone was successfully updated.');
        $setup = $alumnus->initial_setup;
        if ($setup == 0)
            return redirect()->route('users.alumni.milestones.index', compact('user', 'alumnus'));
        elseif ($setup == 1)
            return redirect()->route('users.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param  \App\Alumnus $alumnus
     * @param  \App\Occupation $occupation
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user, Alumnus $alumnus, Occupation $occupation)
    {
        $occupation->delete();

        Session::flash('alert', 'The occupation milestone was successfully deleted.');
        $setup = $alumnus->initial_setup;
        if ($setup == 0)
            return redirect()->route('users.alumni.milestones.index', compact('user', 'alumnus'));
        elseif ($setup == 1)
            return redirect()->route('users.show', compact('user'));
    }
}
