<?php

namespace App\Http\Controllers\Auth;

use App\OAuthDriver;
use App\OAuthUser;
use App\User;
use function MongoDB\BSON\toJSON;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleGoogleProviderCallback()
    {

        $user_by_email = User::where('email',  Socialite::driver('google')->stateless()->user()->email )->first();
        $user_by_id = OAuthUser::where('oauth_id', Socialite::driver('google')->stateless()->user()->id )->first();

        $socialite = Socialite::driver('google)')->stateless()->user();

        if ($user_by_email) {
            $user = $user_by_email;
        } else if ($user_by_id) {
            $user = $user_by_id;
        } else {
            // Create User
            $user = User::create([
                'name' => $socialite->getName(),
                'email' => $socialite->getEmail(),
            ]);
        }

        $oauthUser = OAuthUser::firstOrNew([
            'user_id' => $user->id,
            'oauth_id' => $socialite->getId(),
        ]);

        $oauthUser->user_id = $user->id;
        $oauthUser->oauth_id = $socialite->getId();
        $oauthUser->access_token = $socialite->token;
        $oauthUser->refresh_token = $socialite->refreshToken;
        $oauthUser->oauth_driver_id = OAuthDriver::where('name', $provider)->first()->id;
        $oauthUser->save();

        return response()->json([
            'access_token' => $user->createToken('API Token')->accessToken,
        ]);
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleFacebookProviderCallback()
    {

        $user_by_email = User::where('email',  Socialite::driver('facebook')->stateless()->user()->email )->first();
        $user_by_id = OAuthUser::where('oauth_id', Socialite::driver('facebook')->stateless()->user()->id )->first();

        if ($user_by_id) {
            $user = User::find($user_by_id->user_id);
            // return passport access_token
        }
        elseif ($user_by_email) {
            return Response()->json(['error' => 324, 'message' => 'You already have an account please signin using login credentials and link this social account to use in future.']);
        }
        else {
            // Create user
            // if successful then return passport access_token
        }
    }
}
