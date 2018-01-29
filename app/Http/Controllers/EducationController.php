<?php

namespace App\Http\Controllers;

use App\Education;
use App\Alum;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Alum  $alum
     * @return \Illuminate\Http\Response
     */
    public function index(Alum $alum)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Alum  $alum
     * @return \Illuminate\Http\Response
     */
    public function create(Alum $alum)
    {
        return view('users.alumni.education.create', compact('alum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alum  $alum
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Alum $alum)
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
     * @param  \App\Alum  $alum
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Alum $alum, Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alum  $alum
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Alum $alum, Education $education)
    {
        return view('users.alumni.education.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alum  $alum
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alum $alum, Education $education)
    {

        $education->alumni_id = $alum->id;
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
     * @param  \App\Alum  $alum
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alum $alum, Education $education)
    {
        //
    }
}
