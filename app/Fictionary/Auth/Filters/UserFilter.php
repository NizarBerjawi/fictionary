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
        return $this->builder->where('first_name', 'like', '%'.$name.'%');
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
        return $this->builder->whereHas('profile', function($query) use ($username) {
            $query->where('username', 'like', '%'.$username.'%');
        });
    }

    /**
     * Filter by status
     *
     * @param string $string
     * @return Builder
     */
    public function status(string $status) : Builder
    {
        switch($status) {
            case 'active':
                return $this->active();
            case 'inactive':
                return $this->inactive();
            case 'deleted':
                return $this->deleted();
            default:
                return $this->builder->withTrashed();
        }
    }

    /**
     * Filter by active users.
     *
     * @return Builder
     */
    protected function active() : Builder
    {
        return $this->builder->isActive();
    }

    /**
     * Filter by inactive users.
     *
     * @return Builder
     */
    protected function inactive() : Builder
    {
        return $this->builder->isNotActive();
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
