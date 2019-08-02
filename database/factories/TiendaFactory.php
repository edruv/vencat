<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Tienda;
use Faker\Generator as Faker;

$factory->define(Tienda::class, function (Faker $faker) {
	return [
		'name' => $faker->word,
		'image' => $faker->randomElement(['http://lorempixel.com/200/200/',''])
	];
});
