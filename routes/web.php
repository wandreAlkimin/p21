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
    return redirect('/fans');
});

Route::resource('fans', 'App\FansController');

Route::get('notificar-torcedores', 'App\NotifyFansController@index');
Route::post('notificar-torcedores', 'App\NotifyFansController@notificar');

Route::get('getCidades/{idEstado}', 'App\FansController@getCidades');

Route::get('importar-torcedores', 'ImportExport\ImportTorcedoresController@index');
Route::post('importar-usuarios', 'ImportExport\ImportTorcedoresController@import')->name('importar-usuarios');
Route::get('exportar', 'ImportExport\ExportTorcedoresController@export');