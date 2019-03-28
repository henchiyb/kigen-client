<?php

use App\FarmImage;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(FarmImage::class, function (Faker $faker) {
    return [
        'farm_id' => $faker->numberBetween($min = 1, $max = 10),
        'img_link' => "xoai-cat-chu-da-vang.png"
    ];
});
