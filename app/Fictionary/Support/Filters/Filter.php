<?php

namespace App\Fictionary\Support\Filters;

use ReflectionClass;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

abstract class Filter
{
    /**
     * The query builder
     *
     * @var Builder $builder
     */
    protected $builder;

    /**
     * The HTTP Request
     *
     * @var Request $request
     */
    protected $request;

    /**
     * Filter constructor.
     *
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get all the available filter methods.
     *
     * @return Collection
     */
    protected function getFilterMethods() : Collection
    {
        $class  = new ReflectionClass(static::class);
        $methods = collect($class->getMethods());

        $filterMethods = $methods->map(function($method) use ($class) {
            if ($method->class === $class->getName()) {
                return $method->name;
            }
            return null;
        })->filter();

        return $filterMethods;
    }

    /**
     * Get all the filters that can be applied.
     *
     * @return Collection
     */
    protected function getFilters() : Collection
    {
        $possibleFilters = array_filter_recursive($this->request->all());

        $filters = array_only($possibleFilters, $this->getFilterMethods()->all());

        return collect($filters)->filter();
    }

    /**
     * Set the builder
     *
     * @param Builder $builder
     * @return void
     */
    protected function setBuilder(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Apply all the requested filters if available.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder) : Builder
    {
        $this->setBuilder($builder);

        $filters = $this->getFilters();

        foreach ($filters as $name => $value) {
            if (method_exists($this, $name)) {
                if (!empty($value)) {
                    $this->$name($value);
                } else {
                    $this->$name();
                }
            }
        };

        return $builder;
    }
}
