<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'nombre','temporada','year','portada','tienda'
	];

	function tienda(){
		return $this->belongsTo('App\Tienda','id');
	}
}
