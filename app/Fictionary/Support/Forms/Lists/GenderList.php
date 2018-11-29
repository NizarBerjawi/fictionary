<?php

namespace App\Fictionary\Support\Forms\Lists;

use App\Fictionary\Support\Forms\DataCollection;

class GenderList extends DataCollection
{
    public function getPath()
    {
        return __DIR__ . '/../data/genders.php';
    }
}
