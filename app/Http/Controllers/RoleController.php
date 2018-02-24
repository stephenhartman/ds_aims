<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $users = $this->users->select('id', 'name', 'email')->paginate(10);
        $users->setPath('/roles');

        if ($request->ajax()) {
            return view('roles.load', ['users' => $users])->render();
        }

        return view('roles.index', compact('users'));
    }
}
