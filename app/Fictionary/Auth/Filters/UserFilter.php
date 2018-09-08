<?php

namespace App\Fictionary\Auth\Filters;

use App\Fictionary\Support\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends Filter
{
    /**
     * Filter by user name.
     *
     * @return Builder
     */
    protected function name(string $name) : Builder
    {
        return $this->builder->where('name', 'like', '%'.$name.'%');
    }

    /**
     * Filter by user emails.
     *
     * @return Builder
     */
    protected function email(string $email) : Builder
    {
        return $this->builder->where('email', 'like', '%'.$email.'%');
    }

    /**
     * Filter by username
     *
     * @return Builder
     */
    protected function username(string $username) : Builder
    {
        return $this->builder->where('username', '%'.$username.'%');
    }

    /**
     * Filter by active users.
     *
     * @return Builder
     */
    protected function active() : Builder
    {
        return $this->builder->whereHas('activation', function(Builder $query) {
            return $query->where('is_verified', true);
        });
    }

    /**
     * Filter by inactive users.
     *
     * @return Builder
     */
    protected function inactive() : Builder
    {
        return $this->builder->whereHas('activation', function(Builder $query) {
            return $query->where('is_verified', false);
        });
    }

    /**
     * Filter by deleted users.
     *
     * @return Builder
     */
    protected function deleted() : Builder
    {
        return $this->builder->onlyTrashed();
    }
}
