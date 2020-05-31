<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Products\Config\Category;

$factory->define(Category::class, function (Faker $faker) {
    $category = $faker->unique()->company;
    return [
        'category' => $category,
        'slug' => Str::slug($category, '-'),
        'description' => $faker->text(200)
    ];
});
