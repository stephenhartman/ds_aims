<?php

namespace App\Http\Controllers;

use App\Occupation;
use App\Alumnus;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Alumnus  $alum
     * @return \Illuminate\Http\Response
     */
    public function create(Alumnus $alum)
    {
        return view('users.alumni.occupation.create', compact('alum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumnus  $alum
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Alumnus $alum)
    {
        $this->validate($request, array(
            'organization' => 'required',
            'position' => 'required',
            'start_year' => 'required|size:4'
        ));

        $occupation = new Occupation();

        $occupation->alumni_id = $alum->id;
        $occupation->organization = $request->organization;
        $occupation->position = $request->position;
        $occupation->start_year = $request->start_year;
        $occupation->end_year = $request->end_year;
        $occupation->testimonial = $request->testimonial;
        $occupation->save();

        Session::flash('success', 'The occupation milestone was successfully created!');
        return redirect()->route('users.alumni.show', compact('alum'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumnus  $alum
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Alumnus $alum, Occupation $occupation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumnus  $alum
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumnus $alum, Occupation $occupation)
    {
        return view('users.alumni.occupation.edit', compact('alum', 'occupation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumnus  $alum
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumnus $alum, Occupation $occupation)
    {
        $occupation->organization = $request->organization;
        $occupation->position = $request->position;
        $occupation->start_year = $request->start_year;
        $occupation->end_year = $request->end_year;
        $occupation->testimonial = $request->testimonial;
        $occupation->save();

        Session::flash('success', 'The education milestone was successfully saved.');
        return redirect()->route('users.alumni.show', compact('alum'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumnus  $alum
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumnus $alum, Occupation $occupation)
    {
        $occupation->delete();

        Session::flash('alert', 'The occupation milestone was succesfully deleted.');
        return redirect()->route('users.alumni.show', compact('alum'));
    }
}
