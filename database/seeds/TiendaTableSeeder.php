<?php

use Illuminate\Database\Seeder;

class TiendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(App\Tienda::class,5)->create();
        //
    }
}
