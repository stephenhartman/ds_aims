<?php

namespace App\Social;

use App\User;
use Laravel\Socialite\Facades\Socialite;


/**
 * Abstract class to create social login wrapper classes
 */
 abstract class AbstractServiceProvider
{
    protected $provider;

    /**
     * Create a new SocialServiceProvider instance
     */
    public function __construct()
    {
        $this->provider = Socialite::driver(
            str_replace(
                'serviceprovider', '', strtolower((new \ReflectionClass($this))->getShortName())
            )
        );
    }

    /**
     * Logged in the user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(User $user)
    {
        auth()->login($user);

        return redirect()->intended('/');
    }

    /**
     * Register the user
     *
     * @param array $user
     * @return User $user
     */
    public function register(array $user)
    {
        $password = bcrypt(str_random(10));

        $newUser = User::create(array_merge($user, ['password' => $password]));

        return $newUser;
    }

    /**
     * Redirect the user to provider authentication page
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        return $this->provider->redirect();
    }

    /**
     * Handle data returned by the provider
     *
     * @return \Illuminate\Http\Response
     */
    abstract public function handle();
}