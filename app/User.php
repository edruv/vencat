<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
	 use HasRolesAndPermissions;
	 use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','lastN','alias','ubicacion',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	function ubication(){
		return $this->belongsTo('App\Ubicacion','id');
	}
	/**
	 * Role User
	 */
	function RolUser(){
		return $this->belongsToMany('Caffeinated\Shinobi\Models\Role','role_user')->withPivot('role_id','user_id');
	}

	public function pedidos(){
		return $this->hasMany('App\Pedido','id');
	}
}
