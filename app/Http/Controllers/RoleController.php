<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Html;
use Form;
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
        if (Auth::user()->hasRole('admin')) {
            return view('roles.index');
        }
        Session::flash('error', 'You are not authorized to view this page.');
        return redirect()->route('home');
    }

    /**
     * Process Role DataTables ajax request.
     *
     * @param $datatables DataTables object
     * @return \Illuminate\Http\JsonResponse
     */
    public function role_data(DataTables $datatables)
    {
        $builder = User::select('id', 'name', 'email');

        return $datatables->eloquent($builder)
            ->editColumn('name', function ($user) {
                return Html::linkAction('UserController@show', $user->name, $user->id, array('data-id' => $user->id));
            })
            ->editColumn('email', function ($user) {
                return Html::mailto($user->email) ;
            })
            ->addColumn('role', function (User $user) {
                if ($user->id == Auth::id())
                    return '<input class="form-control" type="checkbox" data-id="'.$user->id.'" name="role" checked disabled="disabled"></td>';
                elseif ($user->hasRole('admin'))
                    return '<input class="form-control" type="checkbox" data-id="'.$user->id.'" name="role" checked>';
                elseif ($user->hasRole('alumni'))
                    return '<input class="form-control" type="checkbox" data-id="'.$user->id.'" name="role" unchecked>';
            })
            ->addColumn('action', function(User $user) {
                return '<button class="btn btn-success btn-sm btn-block btn-ajax" data-id="'.$user->id.'">Save</button>';
            })
            ->rawColumns(array('name', 'email', 'role', 'action'))
            ->make();
    }

    /**
     * Update the specified user role in storage.
     *
     * @param Request $request
     */
    public function updateRole(Request $request)
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_alumni = Role::where('name', 'alumni')->first();

        $user = User::find($request['id']);

        // Save administrator checkbox
        if ($request->ajax()) {
            if ($request['value'] == 'on') {
                $user->roles()->attach($role_admin);
                $user->roles()->detach($role_alumni);
            } else {
                $user->roles()->attach($role_alumni);
                $user->roles()->detach($role_admin);
            }
        }
    }
}
