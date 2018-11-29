<?php

use App\Fictionary\Genres\Genre;
use App\Fictionary\Profiles\Profile;
use App\Fictionary\Support\Forms\Lists\GenreList;
use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    CONST MAX_ALLOWED_GENRES = 15;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createGenres();
        $this->attachGenresToProfiles();
    }

    /**
     * Create some genres
     *
     * @return void
     */
    private function createGenres()
    {
        $genres = new GenreList();
        $genres->loadFromFile();
        $data = [];

        foreach($genres as $genre) {
            // Genre has to be created using eloquent to
            // automatically generate a UUID
            Genre::create(['name'=> $genre]);
        }
    }

    /**
     * Attach a random number of genres to every profile
     *
     * @return void
     */
    private function attachGenresToProfiles()
    {
        $genres = Genre::withTrashed()->get();
        $profiles = Profile::withTrashed()->get();

        foreach($profiles as $profile) {
            $data = $genres->random(mt_rand(1, static::MAX_ALLOWED_GENRES));

            $profile->genres()->attach($data);
        }
    }
}
