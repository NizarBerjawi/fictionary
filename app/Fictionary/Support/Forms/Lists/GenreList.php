<?php

namespace App\Fictionary\Support\Forms\Lists;

use App\Fictionary\Genres\Genre;
use App\Fictionary\Support\Forms\DataCollection;

class GenreList extends DataCollection
{
    /**
     *
     */
    public $fromDatabase = true;

    /**
     *
     */
    public function getPath()
    {
        return __DIR__ . '/../data/genres.php';
    }

    /**
     *
     */
    public static function builder()
    {
        return Genre::orderBy('name');
    }
}
