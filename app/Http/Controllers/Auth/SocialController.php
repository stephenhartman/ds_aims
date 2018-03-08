<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Jrean\UserVerification\Facades\UserVerification;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Session;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected $redirectTo = '/home';

    /**
     * Redirect the user to the OAuth provider of choice
     *
     * @param $provider Socialite provider from login page
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain user information from the selected provider.  Check if the user exists
     * in the database by querying provider_id.  If user exists, log in, else create a new
     * user and log in.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        if($authUser->provider == 'none') {
            Session::flash('error', 'You already created an account using '.$user->email.'.  Please sign in
                using your email and password.  If you have forgotten your password, click the "Forgot Password" button below');
            return redirect('login');
        }
        elseif($authUser->provider != $provider) {
            Session::flash('error', 'You already created an account using '.studly_case($authUser->provider).'.  Please sign in
                using that social media account.');
            return redirect('login');
        }
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before, return the user.  Else, create a new user.
     *
     * @param $user Socialite user object
     * @param $provider Socialite auth provider
     * @return User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        $emailUser = User::where('email', $user->email)->first();
        if($authUser ) {
            Session::flash('success', 'Successfully logged in!  Welcome back '.$authUser->name.'!');
            return $authUser;
        }

        if($emailUser) {
            return $emailUser;
        }

        Session::flash('success', 'You have successfully registered with your '.studly_case($provider).' Account.');
        $user =  User::create([
            'name'          => $user->name,
            'email'         => $user->email,
            'provider'      => $provider,
            'provider_id'   => $user->id
        ]);
        $user
            ->roles()
            ->attach(Role::where('name', 'alumni')->first());

        UserVerification::generate($user);
        UserVerification::send($user, 'Please verify to complete registration at the DePaul Alumni Outreach System.');

        return $user;
    }
}
