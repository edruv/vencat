<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
	use SoftDeletes;

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'product','model','color','size','costo','page'
	];

	public function user(){
		return $this->belongsTo('App\User','id');
	}

	public function status(){
		return $this->hasMany('App\Status','id');
	}
}
