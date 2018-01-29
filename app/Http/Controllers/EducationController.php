<?php

namespace App\Http\Controllers;

use App\Education;
use App\Alumnus;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Alumnus  $alum
     * @return \Illuminate\Http\Response
     */
    public function create(Alumnus $alum)
    {
        return view('users.alumni.education.create', compact('alum'));
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
            'school' => 'required',
            'location' => 'required',
            'start_year' => 'required|size:4'
        ));

        $education = new Education();

        $education->alumni_id = $alum->id;
        $education->school = $request->school;
        $education->location = $request->location;
        $education->start_year = $request->start_year;
        $education->end_year = $request->end_year;
        $education->testimonial = $request->testimonial;
        $education->save();

        Session::flash('success', 'The education milestone was successfully created!');
        return redirect()->route('users.alumni.show', compact('alum'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumnus  $alum
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Alumnus $alum, Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumnus  $alum
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumnus $alum, Education $education)
    {
        return view('users.alumni.education.edit', compact('alum', 'education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumnus  $alum
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumnus $alum, Education $education)
    {

        $education->school = $request->school;
        $education->location = $request->location;
        $education->start_year = $request->start_year;
        $education->end_year = $request->end_year;
        $education->testimonial = $request->testimonial;
        $education->save();

        Session::flash('success', 'The education milestone was successfully saved.');
        return redirect()->route('users.alumni.show', compact('alum'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumnus  $alum
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumnus $alum, Education $education)
    {
        $education->delete();

        Session::flash('alert', 'The education milestone was succesfully deleted.');
        return redirect()->route('users.alumni.show', compact('alum'));
    }
}
