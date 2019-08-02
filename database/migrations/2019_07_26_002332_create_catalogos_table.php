[<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogosTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('catalogos', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('nombre');
			$table->string('temporada')->nullable();
			$table->year('year')->nullable();
			$table->string('portada')->nullable();
			$table->unsignedBigInteger('tienda');
			$table->foreign('tienda')->references('id')->on('tiendas');
			$table->timestamps();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('catalogos');
	}
}
