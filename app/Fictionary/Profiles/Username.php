<?php

namespace App\Fictionary\Profiles;

use App\Fictionary\Auth\User;

class Username
{
    /**
     * Number of attempts.
     */
    const ATTEMPTS = 10;

    /**
     * Attempt to generate a username for the model
     *
     * @param Model $model
     */
    public static function generate(User $user) : string
    {
        /** @var int **/
        $attempts = 0;

        while($attempts <= static::ATTEMPTS) {
            /** @var string **/
            $username = (string) str_slug($user->first_name) . mt_rand(0, 1000);

            // Check if the Uuid already exists
            $exists = $user->profile()
                           ->withoutGlobalScopes()
                           ->where('username', $username)
                           ->exists();

            if (! $exists) {
                return $username;
            }

            $attempts ++;
        }

        throw new \Exception('Could not find a unique username');
    }
}
