<?php

namespace App\Fictionary\Support\Forms\Lists;

use App\Fictionary\Support\Forms\DataCollection;

class CountryList extends DataCollection
{
    public function getPath()
    {
        return __DIR__ . '/../data/countries.php';
    }
}
