<?php

namespace App\Fictionary\Support\Forms;

use Exception;
use ArrayAccess;
use App\Fictionary\Support\Forms\AggregatorInterface;

class DataAggregator implements ArrayAccess, AggregatorInterface
{
    /**
     * The collection of lists
     *
     * @var array
     */
    public $lists;

    /**
     *
     */
    public function __construct(array $lists = [])
    {
        foreach($lists as $list) {
            $this->lists[$list->getName()] = $list;
        }
    }

    /**
     * Determine if an item exists at an offset.
     *
     * @param  mixed  $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->lists);
    }

    /**
     * Get an item at a given offset.
     *
     * @param  mixed  $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->lists[$key];
    }

    /**
     * Set the item at a given offset.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->lists[] = $value;
        } else {
            $this->lists[$key] = $value;
        }
    }

    /**
     * Unset the item at a given offset.
     *
     * @param  string  $key
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->lists[$key]);
    }

    /**
     * Get a specific list
     *
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    public function getList($name, $default)
    {
        if (!is_string($name)) {
            throw new Exception(__FUNCTION__ . ' expects a string');
        }

        return array_get($this->lists, $name, $default);
    }
}
