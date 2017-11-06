<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Social\FacebookServiceProvider;
use App\Social\GoogleServiceProvider;
use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Two\InvalidStateException;
use League\OAuth1\Client\Credentials\CredentialsException;

class SocialController extends Controller
{
    protected $providers = [
        'google' => GoogleServiceProvider::class,
        'facebook' => FacebookServiceProvider::class,
    ];

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Redirect the user to provider authentication page
     *
     * @param string $driver
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(string $driver)
    {
        return (new $this->providers[$driver])->redirect();
    }

    public function handleProviderCallback(string $driver)
    {
        try {
            return (new $this->providers[$driver])->handle();
        } catch (InvalidStateException | ClientException | CredentialsException $e) {
            return $this->redirectToProvider($driver);
        }
    }
}
