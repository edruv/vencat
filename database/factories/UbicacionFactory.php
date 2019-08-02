<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Ubicacion;
use Faker\Generator as Faker;

$factory->define(Ubicacion::class, function (Faker $faker) {
    return [
		 'name' => $faker->state,
        //
    ];
});
