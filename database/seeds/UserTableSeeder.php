<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class UserTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		//
		$r_customer = Role::where('slug','customer')->first()->slug;
		$r_user = Role::where('slug','user')->first()->slug;
		$r_seller = Role::where('slug','seller')->first()->slug;
		$r_admin = Role::where('slug','admin')->first()->slug;
		$r_god = Role::where('slug','god')->first()->slug;

		$user = factory(User::class,15)->create();
		$user->each(function (App\User $u) use ($r_customer){
			$u->assignRoles($r_customer);
		});

		$user = factory(User::class,10)->create();
		$user->each(function (App\User $u) use ($r_user){
			$u->assignRoles($r_user);
		});

		$user = factory(User::class,5)->create();
		$user->each(function (App\User $u) use ($r_seller){
			$u->assignRoles($r_seller);
		});

		$user = factory(User::class,2)->create();
		$user->each(function (App\User $u) use ($r_admin){
			$u->assignRoles($r_admin);
		});

		$user = factory(User::class,1)->create([
			'name' => 'edson yahir',
			'lastN' => 'ruvalcaba lopez',
			'alias' => 'yahir',
			'email' => 'yared-rulop@hotmail.com',
			'password' => bcrypt('modern22'),
		]);
		$user->each(function (App\User $u) use ($r_god){
			$u->assignRoles($r_god);
		});
	}
}
