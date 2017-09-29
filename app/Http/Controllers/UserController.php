<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            //$users = User::where('is_admin', 0);
            return view('users.index');
        }
        Session::flash('error', 'You are not authorized to view this page.');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Auth::user()->is_admin) {
            return view('users.show', compact('user'));
        }
        Session::flash('error', 'You are not authorized to view this page.');
        return redirect()->route('home');
    }
    /**
     * Process datatables ajax request.
     *
     *  @return \Illuminate\Http\JsonResponse
     */
    public function data(DataTables $datatables)
    {
        $builder = User::query()->select('id', 'name', 'email', 'created_at', 'updated_at');

        return $datatables->eloquent($builder)
            ->editColumn('name', function ($user) {
                return "<a>" . $user->name . "</a>";
            })
            ->addColumn('action', 'user.tables.users-action')
            ->rawColumns([1, 5])
            ->make();
    }
}
