<?php

namespace App\Fictionary\Support\Forms\Lists;

use App\Fictionary\Support\Forms\DataCollection;

class StatusList extends DataCollection
{
    public function getPath()
    {
        return __DIR__ . '/../data/statuses.php';
    }
}
