<?php

namespace App\Http\Controllers;

use App\Occupation;
use App\Alum;
use Illuminate\Http\Request;

class OccuptationController extends Controller
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alum  $alum
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Alum $alum, Occupation $occupation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alum  $alum
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function edit(Alum $alum, Occupation $occupation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alum  $alum
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alum $alum, Occupation $occupation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alum  $alum
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alum $alum, Occupation $occupation)
    {
        //
    }
}
