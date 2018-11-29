<?php

namespace App\Fictionary\Profiles\Policies;

use App\Fictionary\Auth\User;
use App\Fictionary\Profiles\Profile;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Authorize before any of the policy methods are called
     *
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine if the given user can create a profile
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->doesntHaveProfile();
    }

    /**
     * Determine if the given user can view a profile
     *
     * @param User $user
     * @return bool
     */
    public function show(User $user, Profile $profile)
    {
        return $user->profile->is($profile);
    }

    /**
     * Determine if the given user can update a profile
     *
     * @param User $user
     * @param Profile $profile
     * @return bool
     */
    public function update(User $user, Profile $profile)
    {
        return $user->hasProfile() && $user->profile->is($profile);
    }

    /**
     * Determine if a user can delete a profile
     *
     * @param User $user
     * @param Profile $profile
     * @return bool
     */
    public function delete(User $user, Profile $profile)
    {
        return $user->hasProfile() && $user->profile->is($profile);
    }
}
