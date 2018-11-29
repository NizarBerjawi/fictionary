<?php

namespace App\Fictionary\Auth\Policies;

use App\Fictionary\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine if a user can delete a user account
     *
     * @param User $user
     * @param User $profile
     * @return bool
     */
    public function delete(User $user, User $account)
    {
        return $user->is($account);
    }

    /**
     * Determine if a user can restore a user account
     *
     * @param User $user
     * @param User $profile
     * @return bool
     */
    public function restore(User $user, User $account)
    {
        return $user->is($account);
    }
}
