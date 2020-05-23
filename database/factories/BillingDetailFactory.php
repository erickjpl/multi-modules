<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Billings\Billing;
use App\Models\Billings\BillingDetail;
use App\Models\Products\Sales\Inventory;

$factory->define(BillingDetail::class, function (Faker $faker) {
    $inventory = Inventory::all()->random();
    return [
        'quantity' => $faker->randomDigitNotNull,
        'tax' => round($inventory->price * 0.16, 2),
        'price' => round($inventory->price / 1.16, 2),
        'discount' => $inventory->discount,
        'inventory_id' => $inventory->id,
        # 'billing_id' => Billing::all()->random()->id
    ];
});
