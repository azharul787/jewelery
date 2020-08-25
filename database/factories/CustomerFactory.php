<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Model\Customer;

$factory->define(Customer::class, function (Faker $faker) {

  /*  $dis = App\Model\Distric::pluck('id')->toArray();
    $upo = App\Model\Upozila::pluck('id')->toArray();
    $uni = App\Model\Union::pluck('id')->toArray();*/
    return [
      /*  'distric_id' => rand(2,12),
        'upozila_id' => rand(1,20),
        'union_id' => rand(2,100),
        */
        /*'distric_id' => $faker->randomElement($dis),
        'upozila_id' => $faker->randomElement($upo),
        'uni' => $faker->randomElement($uni),*/
        'distric_id' => 3,
        'upozila_id' => rand(1,8),
        'union_id' => rand(6,13),
        'customer_name' => $faker->name,
        'customer_phone' => $faker->e164PhoneNumber,
        'customer_email' => $faker->unique()->safeEmail,
        'customer_address' => $faker->address,
    ];
});
