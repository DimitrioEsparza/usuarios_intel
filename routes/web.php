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
/**
 * Inicio
 */
Route::get('/', 'usuariosController@index');

/**
 * Altas
 */
Route::post('/addUsuario', 'usuariosController@add');

/**
 * Bajas
 */
Route::delete('/deleteUsuario', 'usuariosController@delete');

/**
 * Busquedas
 */
Route::get('/searchUsuario', 'usuariosController@getUsuario');

/**
 * Cambios de los datos del usuario
 */ 
Route::get('/updateUsuario/{id}', 'usuariosController@usuariosvista');
Route::put('/updateUsuario', 'usuariosController@putUsuario');

/**
 * Carga masiva de datos de usuario
 */
Route::get('/cargaMasiva', 'usuariosController@cargaMasiva');
Route::post('/cargaMasivaDatos', 'usuariosController@cargaMasivaDatos');


