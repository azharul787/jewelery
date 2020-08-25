<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Model\Supplier;
use App\Model\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => rand(1,6),
        'brand_id' => rand(1,10),
        'unit_id' => rand(1,4),
       /* 'supplier_id' => function () {
            return factory(Supplier::class)->create()->id;
        },*/
        'supplier_id' =>rand(1,300),
        'product_name' => $faker->name,
        'model_no' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'sale_price' => $faker->numberBetween($min = 1000, $max = 9000),
        'supplier_price' => $faker->numberBetween($min = 1000, $max = 9000),
        're_order_label' => $faker->randomDigit,
        'created_by' => 1,
    ];
});
