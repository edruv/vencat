<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'nombre'
	];

	function users(){
		return $this->hasMany('App\User','ubicacion');
	}
}
