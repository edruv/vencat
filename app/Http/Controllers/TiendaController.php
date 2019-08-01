<?php

namespace App\Http\Controllers;

use App\Tienda;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$tiendas = Tienda::all();
		// $tiendas = collect([]);
		// dd($tiendas);

		return view('tienda.index',compact('tiendas'));
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('tienda.create');
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
			'name' => 'required|alpha_num',
			'avatar' => 'nullable'
		]);

		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$name = $request->input('name').date("-y-m-d-His").'.'.$file->guessClientExtension();
			$file->move(public_path().'/images/stores/',$name);
		}

		$tienda = new Tienda();
		$tienda->name = $request->input('name');
		$tienda->image = ($request->hasFile('avatar')) ? $name : '' ;
		$tienda->save();

		return redirect()->route('tienda.index');
	}

	/**
	* Display the specified resource.
	*
	* @param  \App\Tienda  $tienda
	* @return \Illuminate\Http\Response
	*/
	public function show(Tienda $tienda)
	{
		// if ($tienda->ajax()) {
			return response()->json($tienda,200);
		// }
		// return ;
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Tienda  $tienda
	* @return \Illuminate\Http\Response
	*/
	public function edit(Tienda $tienda)
	{
		// dd($tienda);
		return view('tienda.edit',compact('tienda'));
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Tienda  $tienda
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Tienda $tienda)
	{
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$name = $request->input('name').date("-y-m-d-His").'.'.$file->guessClientExtension();
			$oldI = public_path().'/images/stores/'.$tienda->image;
			$file->move(public_path().'/images/stores/',$name);
			\File::delete($oldI);
		}
		$tienda->fill($request->all());

		$tienda->image = ($request->hasFile('avatar')) ? $name : '' ;

		$tienda->save();

		return redirect()->route('tienda.index');
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Tienda  $tienda
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Tienda $tienda)
	{
		$oldI = public_path().'/images/stores/'.$tienda->image;
		\File::delete($oldI);
		$tienda->delete();
		return redirect()->route('tienda.index');
	}
}
