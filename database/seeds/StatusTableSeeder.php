<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		factory(Status::class)->create([
			'status' => 'en proceso'
		]);
		factory(Status::class)->create([
			'status' => 'en camino'
		]);
		factory(Status::class)->create([
			'status' => 'en otra sucursal'
		]);
		factory(Status::class)->create([
			'status' => 'agotado'
		]);
		factory(Status::class)->create([
			'status' => 'cancelado'
		]);
	}
}
