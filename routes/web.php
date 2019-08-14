<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('ubicaciones','UbicacionController');
// Route::resource('ubicaciones','UbicacionController');
Route::get('/ubicaciones','UbicacionController@index')->name('ubicaciones.index');
Route::get('/ubicaciones/nueva','UbicacionController@create')->name('ubicaciones.nueva');
Route::get('/ubicaciones/create','UbicacionController@create')->name('ubicaciones.create');
Route::get('/ubicaciones/{ubicacion}','UbicacionController@show')->name('ubicaciones.show');
Route::get('/ubicaciones/{ubicacion}/edit','UbicacionController@edit')->name('ubicaciones.edit');
Route::post('/ubicaciones','UbicacionController@store')->name('ubicaciones.store');
Route::put('/ubicaciones/{ubicacion}','UbicacionController@update')->name('ubicaciones.update');
Route::delete('/ubicaciones/{ubicacion}','UbicacionController@destroy')->name('ubicaciones.destroy');

Route::resource('catalogos','CatalogoController');
Route::resource('tienda','TiendaController');

// Route::get('usuarios/rol/{role}','UserController@usrole')->name('usuarios.usrole');
Route::resource('usuarios','UserController');

Route::resource('pedidos','PedidoController');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Auth::routes(['register' => false]);
