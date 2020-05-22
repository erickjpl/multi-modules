<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'email' => $faker->unique()->freeEmail,
        'email_verified_at' => $faker->date('Y-m-d H:i:s'),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => $faker->sha256
    ];
});
