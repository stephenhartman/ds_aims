<?php

namespace App\Social;

use App\User;

class GoogleServiceProvider extends AbstractServiceProvider
{
    /**
     * Handle Google response
     *
     * @return \Illuminate\Http\Response
     */
    public function handle()
    {
        $user = $this->provider->fields([
            'first_name',
            'last_name',
            'email',
            'verified',
        ])->user();

        $existingUser = User::where('settings->google_id', $user->id)->first();

        if($existingUser) {
            $settings = $existingUser->settings;

            if (!isset($settings['google_id'])) {
                $settings['google_id'] = $user->id;
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
                'google_id' => $user->id,
            ]
        ]);

        return $this->login($newUser);
    }
}