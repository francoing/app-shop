<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
       'name'=>ucfirst($faker->word) ,// con esta funcion de php aplicamos mayuscula a la primera letra
       'description'=>$faker->sentence(10)

    ];
});
