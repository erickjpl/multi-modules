<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Config\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl(800,600,'food'),
    ];
});
