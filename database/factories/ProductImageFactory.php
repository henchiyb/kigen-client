<?php

use App\ProductImage;
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

$factory->define(ProductImage::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween($min = 1, $max = 9),
        'img_link' => "xoai-cat-chu-da-vang.png"
    ];
});
