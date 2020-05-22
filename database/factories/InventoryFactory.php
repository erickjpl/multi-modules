<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Products\Product;
use App\Models\Products\Sales\Inventory;

$factory->define(Inventory::class, function (Faker $faker) {
    $price = $faker->randomFloat(2, NULL, 500);
    $discount = round( $price * $faker->randomElement( array(null, 5, 10, 20, 40) ) / $price, 2 );
    return [
        'quantity' => rand(0, 99),
        'discount' => $discount,
        'price' => $price,
        'status' => $faker->randomElement( array('disponible', 'no disponible') ),
        'observation' => $faker->text(200),
        'product_id' => Product::all()->random()->id
    ];
});
