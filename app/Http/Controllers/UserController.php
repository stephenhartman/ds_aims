<?php

namespace App\Http\Controllers;

use App\Education;
use App\Occupation;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Jrean\UserVerification\Facades\UserVerification;
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
        if (Auth::user() == $user && Auth::user()->hasRole('admin'))
            return view('admin.show', compact('user'));

        $alumnus = $user->alumnus()->first();
        $educations = Education::where('alumnus_id', $alumnus->id)->get();
        $occupations = Occupation::where('alumnus_id', $alumnus->id)->get();
        if (Auth::user()->hasRole('admin'))
            return view('users.show', compact('user', 'alumnus', 'educations', 'occupations'));
        elseif (Auth::user() == $user)
            return view('users.show', compact('user', 'alumnus', 'educations', 'occupations'));
        else {
            Session::flash('error', 'You are not authorized to view this page.');
            return redirect()->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //validate
        $this->validate($request, array(
            'email' => 'required|email',
        ));

        if ($request->email !== $user->email)
        {
            $users = User::all();
            foreach ($users as $user_check)
            {
                if ($request->email == $user_check->email){
                    Session::flash('error', 'That email is already registered with an account');
                    return redirect()->route('users.show', compact('user'));
                }
            }
            $user->email = $request->email;
            $user->verified = 0;
            $user->verification_token = NULL;
            $user->provider = 'none';
            $user->provider_id = NULL;
            $user->save();
            UserVerification::generate($user);
            UserVerification::send($user, 'Please verify your new email address to update registration at the DePaul Alumni Outreach System.');
        }

        if ($user->hasRole('admin'))
        {
            $user->name = $request->name;
            $user->save();
        }

        $user->save();

        Session::flash('success', 'Your account was successfully updated!');
        return redirect()->route('users.show', compact('user'));
    }

    /**
     * Process Alumni DataTables ajax request.
     *
     * @param $datatables DataTables object
     * @return \Illuminate\Http\JsonResponse
     */
    public function alumni_data(DataTables $datatables)
    {
        $builder = User::has('alumnus')
            ->select('id', 'name', 'email', 'last_login_at');

            return $datatables->eloquent($builder)
                ->editColumn('last_login_at', function ($user) {
                    if ($user->last_login_at !== null)
                    return Carbon::parse($user->last_login_at)->format('m/d/Y g:i A ');
                })
                ->editColumn('name', function ($user) {
                    return Html::linkAction('UserController@show', $user->alumnus->first_name . ' ' . $user->alumnus->last_name, $user->id) ;
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
                ->addColumn('is_parent', function (User $user) {
                    if ($user->alumnus)
                        if ($user->alumnus->is_parent == 1)
                            return 'Yes';
                        elseif ($user->alumnus->is_parent == 0)
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

    /**
     * Process Alumni Education DataTables ajax request.
     *
     * @return mixed
     * @throws \Exception
     */
    public function occupation_data()
    {
        $occupations = DB::table('users')
            ->join('alumni', 'users.id', '=', 'alumni.user_id')
            ->join('occupations', 'alumni.id', '=', 'occupations.alumnus_id')
            ->select(['users.id', 'alumni.first_name', 'alumni.last_name', 'users.email', 'occupations.organization'
                , 'occupations.position', 'occupations.start_year', 'occupations.end_year'
                , 'occupations.testimonial', 'occupations.share']);

        return Datatables::of($occupations)
            ->editColumn('name', function ($model) {
                return Html::linkAction('UserController@show', $model->first_name . ' ' . $model->last_name, $model->id) ;
            })
            ->editColumn('email', function ($model) {
                return Html::mailto($model->email) ;
            })
            ->editColumn('share', function ($model) {
                if ($model->share == 1)
                    return 'Yes';
                elseif ($model->share == 0)
                    return 'No';
                else
                    return '';
            })
            ->rawColumns(['testimonial', 'name', 'email'])
            ->make();
    }

    /**
     * Process Alumni Occupation DataTables ajax request.
     *
     * @return mixed
     * @throws \Exception
     */
    public function education_data()
    {
        $educations = DB::table('users')
            ->join('alumni', 'users.id', '=', 'alumni.user_id')
            ->join('educations', 'alumni.id', '=', 'educations.alumnus_id')
            ->select(['users.id', 'alumni.first_name', 'alumni.last_name', 'users.email', 'educations.diploma'
                , 'educations.school', 'educations.location', 'educations.start_year'
                , 'educations.end_year', 'educations.testimonial', 'educations.share']);

        return Datatables::of($educations)
            ->editColumn('name', function ($model) {
                return Html::linkAction('UserController@show', $model->first_name . ' ' . $model->last_name, $model->id) ;
            })
            ->editColumn('email', function ($model) {
                return Html::mailto($model->email) ;
            })
            ->editColumn('share', function ($model) {
                if ($model->share == 1)
                    return 'Yes';
                elseif ($model->share == 0)
                    return 'No';
                else
                    return '';
            })
            ->rawColumns(['testimonial', 'name', 'email'])
            ->make();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function education()
    {
        if (Auth::user()->hasRole('admin')) {
            return view('users.education');
        }
        Session::flash('error', 'You are not authorized to view this page.');
        return redirect()->route('home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function occupation()
    {
        if (Auth::user()->hasRole('admin')) {
            return view('users.occupation');
        }
        Session::flash('error', 'You are not authorized to view this page.');
        return redirect()->route('home');
    }
}
