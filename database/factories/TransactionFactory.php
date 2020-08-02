<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use App\User;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'type' => $faker->randomElement($array = array ('1','2')),
        'amount' => $faker->numberBetween(100,2000),
    ];
});
