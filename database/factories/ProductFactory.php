<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Products\Product;
use App\Models\Products\Config\Category;

$factory->define(Product::class, function (Faker $faker) {
    $product = $faker->unique()->company;
    return [
        'product' => $product,
        'slug' => Str::slug($product, '-'),
        'description' => $faker->text(200),
        'category_id' => Category::all()->random()->id
    ];
});
