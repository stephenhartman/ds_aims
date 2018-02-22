<?php

namespace App\Http\Controllers;

use App\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email')->get();
        return view('roles.index', compact('users'));
    }
}
