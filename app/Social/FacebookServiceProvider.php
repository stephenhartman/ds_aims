<?php

namespace App\Social;

use App\User;

class FacebookServiceProvider extends AbstractServiceProvider
{
    /**
     * Handle Facebook response
     *
     * @return \Illuminate\Http\Response
     */
    public function handle()
    {
        $user = $this->provider->fields([
            'first_name',
            'last_name',
            'email',
        ])->user();

        $existingUser = User::where('settings->facebook_id', $user->id)->first();

        if($existingUser) {
            $settings = $existingUser->settings;

            if (!isset($settings['facebook_id'])) {
                $settings['facebook_id'] = $user->id;
                $existingUser->settings = $settings;
                $existingUser->save();
            }

            return $this->login($existingUser);
        }

        $newUser = $this->register([
            'first_name' => $user->user['first_name'],
            'last_name' => $user->user['last_name'],
            'email' => $user->email,
            'settings' => [
                'facebook_id' => $user->id,
            ]
        ]);

        return $this->login($newUser);
    }
}
