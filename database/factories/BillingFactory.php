<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Billings\Billing;
use App\Models\Customers\Customer;

$factory->define(Billing::class, function (Faker $faker) {

    return [
        'way_paying' => $faker->randomElement( array('efectivo', 'cheque', 'tarjeta de credito', 'nota de credito', 'cupon') ),
        'withdraw_order' => $faker->randomElement( array('delibery', 'en tienda') ),
        'status' => $faker->randomElement( array('pendiente', 'en proceso', 'enviada', 'retirada', 'recibida', 'no procesada') ),
        'customer_id' => Customer::all()->random()->id
    ];
});
