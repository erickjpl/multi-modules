<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile\User;
use Faker\Generator as Faker;
use App\Models\Customers\Customer;

$factory->define(Customer::class, function (Faker $faker) {

    return [
        'name' => $faker->firstName('male'|'female'),
        'lastname' => $faker->lastName,
        'dni' => rand(1000000, 99999999),
        'phone' => '+58 ('.Arr::random([212, 412, 414, 416, 424, 426]).') '.rand(1000000, 9999999),
        'address' => $faker->text(200),
        'user_id' => User::all()->random()->id
    ];
});
