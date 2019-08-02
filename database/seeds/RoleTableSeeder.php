<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RoleTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		//
		$role = new Role();
		$role->name = 'Cliente';
		$role->slug = 'customer';
		$role->description = 'Solo puede solicitar pedidos y ver el status de este';
		$role->save();

		$role = new Role();
		$role->name = 'Usuario';
		$role->slug = 'user';
		$role->description = 'Puede ingresar al sistema y ver sus pedidos, asi como su saldo';
		$role->save();

		$role = new Role();
		$role->name = 'Vendedor';
		$role->slug = 'seller';
		$role->description = 'Puede crear, ver, modificar y eliminar pedidos, asi como crear,ver, modificar y eliminar clientes y usuarios';
		$role->save();

		$role = new Role();
		$role->name = 'Administrador';
		$role->slug = 'admin';
		$role->description = 'Tiene acceso a todas las areas del sistema';
		$role->special = 'all-access';
		$role->save();

		$role = new Role();
		$role->name = 'God Mode';
		$role->slug = 'god';
		$role->description = 'God Mode';
		$role->special = 'all-access';
		$role->save();

	}
}
