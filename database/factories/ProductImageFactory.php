<?php


use Faker\Generator as Faker;
use App\ProductImage;


$factory->define(ProductImage::class, function (Faker $faker) {
    return [
       'image'=>'https://picsum.photos/250/250/?random',
       'product_id'=>$faker->numberBetween(1,100)
    ];
});
