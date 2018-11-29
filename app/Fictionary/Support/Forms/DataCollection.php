<?php

namespace App\Fictionary\Support\Forms;

use ReflectionClass;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

abstract class DataCollection extends Collection
{
    /**
     * Determine if a list is loaded from the database
     *
     * @var bool
     */
    public $fromDatabase = false;

    /**
     * Initialize the Data List
     *
     * @return void
     */
    public function __construct($items = [])
    {
        parent::__construct($items);

        if (!empty($items)) {
            return $this->items = $items;
        }

        if (!$this->fromDatabase) {
            return $this->loadFromFile();
        }

        $exists = $this->loadFromDatabase();
    }

    /**
     * The location of the data file
     *
     * @return string
     */
    abstract function getPath();

    /**
     * The name of the list
     *
     * @return string
     */
    public function getName()
    {
        $reflect = new ReflectionClass($this);

        return Str::snake($reflect->getShortName());
    }

    /**
     * Get the key of a specific value or multiple values
     *
     * @param mixed $values
     * @return mixed
     */
    public function getIdentifiers($values)
    {
        if (!is_array($values)) {
            return [$this->search($values)];
        }

        $identifiers = $this->intersect($values)
                            ->keys()
                            ->map(function($identifier) {
                                return (string) $identifier;
                            })->all();

        return $identifiers;
    }

    /**
     * Load the data from a data file into the list object
     *
     * @return boolean
     */
    public function loadFromFile()
    {
        $file = $this->getPath();

        if (file_exists($file)) {
            $this->items = include($file);
            return true;
        }

        return false;
    }

    /**
     * Load the data from the database
     *
     * @return bool
     */
    public function loadFromDatabase()
    {
        if (!method_exists(static::class, 'builder')) {
            throw new Exception('The builder method is not defined.');
        }

        $builder= static::builder();
        $data = $builder->get();
        $this->items = $data->items;
        return true;
    }
}
