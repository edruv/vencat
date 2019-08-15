<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('pedidos', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('product')->nullable();
			$table->string('model');
			$table->string('color')->nullable();
			$table->string('size')->nullable();
			$table->float('costo',8,2);
			$table->integer('page');
			$table->unsignedBigInteger('customer');
			$table->unsignedBigInteger('taken');
			$table->foreign('customer')->references('id')->on('users');
			$table->foreign('taken')->references('id')->on('users');
			$table->SoftDeletes();
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
		Schema::dropIfExists('pedidos');
	}
}
