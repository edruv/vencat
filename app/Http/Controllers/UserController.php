<?php

namespace App\Http\Controllers;

use App\User;
use App\Ubicacion;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

/**
 * // NOTE:
 * agregar css al subir de role
 */
class UserController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		// $ubics = Ubicacion::all();
		$users = User::all();
		// $rol = Role::where('slug','customer')->pluck('id');
		// $users = Role::find($rol[0])->users;
		//
		foreach ($users as $u) {

			$ubic = Ubicacion::find($u->ubicacion);
			$role = $u->RolUser[0];
			$u->ubicacion = $ubic->name;
			$u->role = $role->slug;
			// $u->role = $u->id;
			unset($u->RolUser);
		}

		// echo $users;

		// dd($users);
		return view('user.index',compact('users'));
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		$ubics = Ubicacion::all();
		$roles = Role::all()->except(Role::whereIn('slug',['god','user'])->pluck('id')->toArray());

		return view('user.create', compact('ubics','roles'));
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(StoreUserRequest $request)
	{
		$user = new User();

		$user->name = $request->input('name');
		$user->lastN = $request->input('lastn');
		$user->alias = $request->input('alias');
		$user->ubicacion = $request->input('place');

		if ($request->input('role') != 1) {
			$user->email = $request->input('email');
			$user->password = bcrypt($request->input('passw'));
		}

		$user->save();

		$role = Role::find($request->input('role'));
		$user = User::find($user->id);
		$user->assignRoles($role->slug);

		return redirect()->route('usuarios.index')->with('success','Usuario creado exitosamente.');
	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id, Request $request)
	{
		$user = User::find($id);
		$role = $user->RolUser[0];
		$user->role = $role->name;
		$user->ubicacion = Ubicacion::find($user->ubicacion)->name;
		unset($user->RolUser);

		if ($request->ajax()) {
			return response()->json($user);
		}

		// echo $user;
		return view('user.show',compact('user'));
	}

	/**
	 * microservice to get user role
	 * @param  [string] $role [get role slug]
	 * @return \Illuminate\Http\Response
	 */
	// public function usrole($role){
	// 	// if ($role->isAjax()) {
	// 		$rol = Role::where('slug',$role)->pluck('id');
	// 		$users = Role::find($rol[0])->users;
	//
	// 		foreach ($users as $u) {
	// 			$ubic = Ubicacion::find($u->ubicacion);
	// 			$u->ubicacion = $ubic->name;
	// 			unset($u->pivot);
	// 		}
	//
	// 		return $users;
	// 	// }else {
	// 	// 	return 'nop';
	// 	// }
	// }

	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$user = User::find($id);
		$ubics = Ubicacion::all();
		$roles = Role::all()->except(Role::where('slug','god')->pluck('id')->toArray());
		$role = $user->RolUser[0];
		$user->role = $role->id;
		unset($user->RolUser);

		// echo $user;
		// echo $roles;
		return view('user.edit',compact('user','ubics','roles'));
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id)
	{
		$user = User::find($id);
		$rol = $user->roles[0];
		$user->role = $rol->id;

		if ($request->role != $user->role) {
			$newRole = Role::find($request->role);
			$user->removeRoles($rol->slug);
			$user->assignRoles($newRole->slug);
		}
		unset($user->role);

		$data = $request->except(['role','place']);
		$user->ubicacion = $request->input('place');
		$user->fill($data)->save();

		// echo $user;
		return redirect()->route('usuarios.show',$user->id)->with('success','Actualizado exitosamente.');
		// return $user;
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();

		return redirect()->route('usuarios.index')->with('danger','Usuario eliminado exitosamente.');

	}
}
