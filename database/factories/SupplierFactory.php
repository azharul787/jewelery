<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Model\Supplier;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'supplier_name' => $faker->name,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
    ];
});
