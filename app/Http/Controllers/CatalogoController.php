<?php

namespace App\Http\Controllers;

use App\Catalogo;
use App\Tienda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		// $catalogos = Catalogo::with('tienda')->get()->sortBy('tienda');
		// $catalogos = Catalogo::all()->sortBy('tienda');
		$catalogos = Catalogo::all()->sortBy('tienda')->sortByDesc('year');

		foreach ($catalogos as $catalogo) {
			$t = Tienda::find($catalogo->tienda);
			$catalogo->tienda = $t->name;
			// echo $catalogo->tienda.'<br>';
			// echo $catalogo->tienda.'-'.$t->name.'<br>';
		}
		return view('catalogo.index',compact('catalogos'));
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		$y = Carbon::now();
		$years = range($y->year+1,$y->year-2);
		$tiendas = Tienda::all();
		return view('catalogo.create',compact('tiendas','years'));
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
			'nombre' => 'required|regex:/^[a-zA-Z0-9-_\s]+$/',
			'tienda' => 'required',
			// 'temporada' => 'regex:/^[a-zA-Z0-9-_\s]+$/',
			'portada' => 'image'
		]);

		if ($request->hasFile('portada')) {
			$file = $request->file('portada');
			$name = $request->tienda.'-'.$request->input('nombre').date('-y-m-d-His').'.'.$file->guessClientExtension();
			$file->move(public_path().'/images/catalogos/',$name);
		}

		$catalogo = new Catalogo();
		$catalogo->nombre = $request->input('nombre');
		$catalogo->temporada = $request->input('temporada');
		$catalogo->year = $request->input('year');
		$catalogo->tienda = $request->input('tienda');
		$catalogo->portada = ($request->hasFile('portada')) ? $name : '' ;
		$catalogo->save();

		return redirect()->route('catalogos.index');
	}

	/**
	* Display the specified resource.
	*
	* @param  \App\Catalogo  $catalogo
	* @return \Illuminate\Http\Response
	*/
	public function show(Catalogo $catalogo)
	{
		return response()->json($catalogo,200);
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Catalogo  $catalogo
	* @return \Illuminate\Http\Response
	*/
	public function edit(Catalogo $catalogo)
	{
		$y = Carbon::now();
		$years = range($y->year+1,$y->year-2);
		$tiendas = Tienda::all();
		return view('catalogo.edit',compact('catalogo','tiendas','years'));
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Catalogo  $catalogo
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Catalogo $catalogo)
	{
		if ($request->hasFile('portada')) {
			$file = $request->file('portada');
			$name = $request->tienda.'-'.$request->input('nombre').date('-y-m-d-His').'.'.$file->guessClientExtension();
			$oldI = public_path().'/images/catalogos/'.$catalogo->portada;
			$file->move(public_path().'/images/catalogos/',$name);
			\File::delete($oldI);
		}
		$catalogo->fill($request->all());

		$catalogo->portada = ($request->hasFile('portada')) ? $name : '' ;

		$catalogo->save();

		return redirect()->route('catalogos.index');
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Catalogo  $catalogo
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Catalogo $catalogo)
	{
		$oldI = public_path().'/images/catalogos/'.$catalogo->portada;
		\File::delete($oldI);
		$catalogo->delete();
		return redirect()->route('catalogos.index');
	}
}
