<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon;
use Html;

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
        $builder = User::query()->select('id', 'name', 'email', 'last_login_at');

            return $datatables->eloquent($builder)
                ->editColumn('last_login_at', function ($user) {
                    if ($user->last_login_at !== null)
                    return Carbon::parse($user->last_login_at)->format('m/d/Y g:i A ');
                })
                ->editColumn('name', function ($user) {
                    return Html::linkAction('UserController@show', $user->name, $user->id) ;
                })
                ->editColumn('email', function ($user) {
                    return Html::mailto($user->email) ;
                })
            ->addColumn('action', 'user.tables.users-action')
            ->rawColumns([1, 5])
            ->make();
    }
}
