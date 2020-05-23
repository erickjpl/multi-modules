<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Products\Product;
use App\Models\Products\Sales\Inventory;

$factory->define(Inventory::class, function (Faker $faker) {
    $price = $faker->randomFloat(2, 18, 499);
    $promotion = $faker->randomElement( array(0.05, 0.10, 0.20, 0.40) );
    $discount = round( $price * $promotion, 2 );
    return [
        'quantity' => rand(0, 99),
        'promotion' => $promotion * 100,
        'discount' => $discount,
        'price' => $price,
        'status' => $faker->randomElement( array('in shop', 'available', 'sold out') ),
        'observation' => $faker->text(200),
        'product_id' => Product::all()->random()->id
    ];
});
