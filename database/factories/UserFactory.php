<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Ubicacion;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
	$ubics = Ubicacion::pluck('id')->toArray();
    return [
        'name' => $faker->firstName,
		  'lastN' => $faker->lastName,
		  'alias' => $faker->randomElement(['','Lic. ','','Ing. ','','Arq. ']).$faker->firstName.' '.$faker->lastName,
        'email' => $faker->unique()->email,
        'email_verified_at' => now(),
        'password' => bcrypt('123456'), // password
		  'ubicacion' => $faker->randomElement($ubics),
        // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
