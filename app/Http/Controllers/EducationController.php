<?php

namespace App\Http\Controllers;

use App\Education;
use App\Alumnus;
use App\User;
use Illuminate\Support\Facades\Session;
use Purifier;
use Illuminate\Http\Request;

class EducationController extends Controller
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
        return view('users.alumni.education.create', compact('user','alumnus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User  $user
     * @param  \App\Alumnus  $alumnus
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Alumnus $alumnus)
    {
        // validate the data
        $this->validate($request, array(
            'type' => 'required',
            'diploma' => 'required',
            'school' => 'required',
            'location' => 'required',
            'start_year' => 'required'
        ));

        $education = new Education();

        $education->alumnus_id = $alumnus->id;
        $education->type = $request->type;
        $education->diploma = $request->diploma;
        $education->school = $request->school;
        $education->location = $request->location;
        $education->start_year = $request->start_year;
        $education->end_year = $request->end_year;
        $education->testimonial = Purifier::clean($request->testimonial);

        // Save share checkbox
        if(!$request->has('share'))
            $request->merge(['share' => 0]);
        else
            $request->merge(['share' => 1]);
        $education->share = $request->share;

        $education->save();

        Session::flash('success', 'The education milestone was successfully created!');
        $setup = $alumnus->initial_setup;
        if ($setup == 0)
            return redirect()->route('users.alumni.milestones.index', compact('user', 'alumnus'));
        elseif ($setup == 1)
            return redirect()->route('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User  $user
     * @param  \App\Alumnus  $alumnus
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Alumnus $alumnus, Education $education)
    {
        return view('users.alumni.education.edit', compact('user', 'alumnus', 'education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User  $user
     * @param  \App\Alumnus  $alumnus
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Alumnus $alumnus, Education $education)
    {
        // validate the data
        $this->validate($request, array(
            'type' => 'required',
            'diploma' => 'required',
            'school' => 'required',
            'location' => 'required',
            'start_year' => 'required'
        ));

        $education->type = $request->type;
        $education->diploma = $request->diploma;
        $education->school = $request->school;
        $education->location = $request->location;
        $education->start_year = $request->start_year;
        $education->end_year = $request->end_year;
        $education->testimonial = Purifier::clean($request->testimonial);

        // Save share checkbox
        if(!$request->has('share'))
            $request->merge(['share' => 0]);
        else
            $request->merge(['share' => 1]);
        $education->share = $request->share;

        $education->save();

        Session::flash('success', 'The education milestone was successfully updated.');
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
     * @param  \App\Education $education
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user, Alumnus $alumnus, Education $education)
    {
        $education->delete();

        Session::flash('alert', 'The education milestone was successfully deleted.');
        $setup = $alumnus->initial_setup;
        if ($setup == 0)
            return redirect()->route('users.alumni.milestones.index', compact('user', 'alumnus'));
        elseif ($setup == 1)
            return redirect()->route('users.show', compact('user'));
    }
}
