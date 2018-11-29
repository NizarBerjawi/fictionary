<?php

namespace App\Fictionary\Support\Forms;

interface AggregatorInterface
{
    /**
     * Get a specific list from the aggregated lists.
     *
     * @param string $name
     * @param mixed $default
     */
    public function getList($name, $default);
}
