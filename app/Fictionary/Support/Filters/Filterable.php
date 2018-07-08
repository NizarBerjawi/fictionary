<?php

namespace App\Fictionary\Support\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Scope a query to apply given filter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param Filter $filter
     * @return
     */
    public function scopeFilter(Builder $query, Filter $filter)
    {
        return $filter->apply($query);
    }
}
