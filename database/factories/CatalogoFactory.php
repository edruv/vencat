<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Catalogo;
use App\Tienda;

$factory->define(Catalogo::class, function (Faker $faker) {
	$tiendas = Tienda::pluck('id')->toArray();
	$y = now();
	$years = range($y->year+1,$y->year-2);
	return [
		'nombre' => $faker->sentence(3, true),
		'temporada' => $faker->randomElement([$faker->word,'']),
		'year' => $faker->randomElement($years),
		'portada' => $faker->randomElement([$faker->imageUrl(250,450,'fashion'),'']),
		'tienda' => $faker->randomElement($tiendas),
	];
});
