<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Html;
use Form;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
                return Html::linkAction('UserController@show', $user->name, $user->id) ;
            })
            ->editColumn('email', function ($user) {
                return Html::mailto($user->email) ;
            })
            ->setRowAttr('form', function (User $user) {
                return array(Form::open( ['route' => ['users.update', $user], 'method' => 'PUT']));
            })
            ->addColumn('role', function (User $user) {
                if ($user->id == Auth::id())
                    return '<input class="form-control" type="checkbox" name="role" checked disabled="disabled"></td>';
                elseif ($user->hasRole('admin'))
                    return '<input class="form-control" type="checkbox" name="role" checked>';
                elseif ($user->hasRole('alumni'))
                    return '<input class="form-control" type="checkbox" name="role" unchecked>';
            })
            ->addColumn('action', function() {
                return Form::submit('Save', ['class' => 'btn btn-success btn-sm btn-block btn-ajax']) . Form::close();
            })
            ->rawColumns(array(0, 1, 2, 3, 4, 5))
            ->make();
    }
}
