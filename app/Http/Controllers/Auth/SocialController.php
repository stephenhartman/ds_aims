<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
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
     * Obtain user infromation from the selected provider.  Check if the user exists
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
        if($authUser) {
            Session::flash('success', 'Successfully logged in!  Welcome '.$authUser->name.'!');
            return $authUser;
        }

        Session::flash('success', 'You have successfully registered with your '.studly_case($provider).' Account.');
        return User::create([
            'name'          => $user->name,
            'email'         => $user->email,
            'provider'      => $provider,
            'provider_id'   => $user->id
        ]);
    }
}
