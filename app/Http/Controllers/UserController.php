<?php

namespace App\Http\Controllers;

use App\Education;
use App\Occupation;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use \Carbon\Carbon;
use Html;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
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
        if (Auth::user()->hasRole('admin')) {
            return view('users.index');
        }
        Session::flash('error', 'You are not authorized to view this page.');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $alumnus = $user->alumnus()->first();
        $educations = Education::where('alumni_id', $alumnus->id)->get();
        $occupations = Occupation::where('alumni_id', $alumnus->id)->get();
        if (Auth::user()->hasRole('admin'))
            return view('users.show', compact('user', 'alumnus', 'educations', 'occupations'));
        elseif (Auth::user() == $user )
            return view('users.show', compact('user', 'alumnus', 'educations', 'occupations'));
        else {
            Session::flash('error', 'You are not authorized to view this page.');
            return redirect()->route('home');
        }
    }
    /**
     * Process DataTables ajax request.
     *
     * @param $datatables DataTables object
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(DataTables $datatables)
    {
        $builder = User::has('alumnus')
            ->select('id', 'name', 'email', 'last_login_at');

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
                ->addColumn('state', function (User $user) {
                    return $user->alumnus ? $user->alumnus->state : '';
                })
                ->addColumn('zipcode', function (User $user) {
                    return $user->alumnus ? $user->alumnus->zipcode : '';
                })
                ->addColumn('year_graduated', function (User $user) {
                    return $user->alumnus ? $user->alumnus->year_graduated : '';
                })
                ->addColumn('volunteer', function (User $user) {
                    if ($user->alumnus)
                        if ($user->alumnus->volunteer == 1)
                            return 'Yes';
                        elseif ($user->alumnus->volunteer == 0)
                            return 'No';
                        else
                            return '';
                })
                ->addColumn('loyal_lion', function (User $user) {
                    if ($user->alumnus)
                        if ($user->alumnus->loyal_lion == 1)
                            return 'Yes';
                        elseif ($user->alumnus->loyal_lion == 0)
                            return 'No';
                        else
                            return '';
                })
                ->addColumn('date_sort', function ($user) {
                    if ($user->last_login_at !== null)
                        return Carbon::parse($user->last_login_at)->format('Ymd');
                })
            ->make();
    }
}
