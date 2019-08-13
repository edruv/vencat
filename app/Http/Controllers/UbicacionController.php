<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use Illuminate\Http\Request;

/**
 * //// NOTE:
 * agrear slug para validar que sea unico
 */

class UbicacionController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(){
		$ubicaciones = Ubicacion::all();
		return view('ubicacion.index',compact('ubicaciones'));
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(){
		return view('ubicacion.create');
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'regex:/^[a-zA-Z0-9-_\s]+$/|required',
		]);

		$ubicacion = new Ubicacion();
		$ubicacion->name = $request->input('name');
		$ubicacion->save();

		return redirect()->route('ubicaciones.index');
	}

	/**
	* Display the specified resource.
	*
	* @param  \App\Ubicacion  $ubicacion
	* @return \Illuminate\Http\Response
	*/
	public function show(Ubicacion $ubicacion)
	{
		return response()->json($ubicacion,200);
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Ubicacion  $ubicacion
	* @return \Illuminate\Http\Response
	*/
	public function edit(Ubicacion $ubicacion)
	{
		return view('ubicacion.edit',compact('ubicacion'));
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Ubicacion  $ubicacion
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Ubicacion $ubicacion)
	{
		// return $request->all();
		$ubicacion->fill($request->all());
		$ubicacion->save();

		return redirect()->route('ubicaciones.index');
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Ubicacion  $ubicacion
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Ubicacion $ubicacion)
	{
		$ubicacion->delete();
		return redirect()->route('ubicaciones.index');
	}
}
