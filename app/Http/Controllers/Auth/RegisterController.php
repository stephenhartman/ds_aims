<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Jrean\UserVerification\Facades\UserVerification as UserVerificationFacade;
use Jrean\UserVerification\Exceptions\UserNotFoundException;
use Jrean\UserVerification\Exceptions\UserIsVerifiedException;
use Jrean\UserVerification\Exceptions\TokenMismatchException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $redirectAfterVerification = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user
            ->roles()
            ->attach(Role::where('name', 'alumni')->first());
        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        event(new Registered($user));

        $this->guard()->login($user);

        UserVerification::generate($user);

        UserVerification::send($user, 'Please verify to complete registration at the DePaul Alumni Outreach System.', 'no-reply@depaulalumni.com');

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Handle the user verification.
     *
     * @param Request $request
     * @param  string $token
     * @return \Illuminate\Http\Response
     */
    public function getVerification(Request $request, $token)
    {
        if (! $this->validateRequest($request)) {
            return redirect($this->redirectIfVerificationFails());
        }
        try {
            $user = UserVerificationFacade::process($request->input('email'), $token, $this->userTable());
        } catch (UserNotFoundException $e) {
            Session::flash('error', 'The user account was not found.  Please contact the system administrator.');
            return redirect($this->redirectIfVerificationFails());
        } catch (UserIsVerifiedException $e) {
            Session::flash('error', 'You have already confirmed your account.');
            return redirect($this->redirectIfVerified());
        } catch (TokenMismatchException $e) {
            Session::flash('error', 'Please check your email for the latest verification from the DePaul School.');
            return redirect($this->redirectIfVerificationFails());
        }
        if (config('user-verification.auto-login') === true) {
            auth()->loginUsingId($user->id);
        }
        if ($request->user()->password == NULL && $request->user()->provider == 'none')
        {
            Session::flash('message', 'You will need to reset your password to complete changes to your account');
            return redirect()->route('password.request');
        }
        if ($request->user()->alumnus()->initial_setup == 0)
            Session::flash('success', 'Thanks for verifying your email!  Please continue by creating an alumni account.');
        else
            Session::flash('success', 'Thanks for verifying your email!');
        return redirect($this->redirectAfterVerification());
    }
}
