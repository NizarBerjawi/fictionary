<?php

use Faker\Generator as Faker;
use App\Fictionary\Profiles\Profile;
use App\Fictionary\Support\Forms\Lists\GenderList;
use App\Fictionary\Support\Forms\Lists\CountryList;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_uuid' => $faker->uuid,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'username' => $faker->unique()->userName,
        'gender' => $faker->randomElement((new GenderList())->keys()->all()),
        'country' => $faker->randomElement((new CountryList())->keys()->all()),
        'date_of_birth' => $faker->dateTimeThisCentury($max = 'now', $timezone = null)->format('Y-m-d'),
        'photo' => 'photos/0JiWOIVUbZkWgCKdTO0nALcvhMqV03x8u90qbieD.jpeg',
        'about_me' => $faker->paragraphs($nb = 3, $asText = true),
    ];
});
