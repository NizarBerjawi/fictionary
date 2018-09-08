<?php

use Faker\Generator as Faker;
use App\Fictionary\Auth\Activation;
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

$factory->define(Activation::class, function (Faker $faker) {
    return [
        'token' => Activation::generateToken(),
        'is_verified' => $faker->boolean($chanceOfGettingTrue = 75),
    ];
});
