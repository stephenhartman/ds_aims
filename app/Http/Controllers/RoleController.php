<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $role_admin  = Role::where('name', 'admin')->first();
        $role_alumni = Role::where('name', 'alumni')->first();

        // Save administrator checkbox
        if ($request->has('role'))
        {
            $user->roles()->attach($role_admin);
        }
        else
            $user->roles()->attach($role_alumni);


        $users = DB::table('users');

        Session::flash('success', 'The user role was successfully saved.');
        return redirect()->route('roles.index', compact('users'));
    }
}
