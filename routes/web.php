<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', 'DashboardController@home')->name('home');

Route::get('/','LoginController@getLogin')->name('login');
Route::get('/login','LoginController@getLogin')->name('login');
Route::post('/logar/usuario', 'LoginController@postLogin')->name('logar.usuario');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::group(['namespace' => 'Tecnico', 'prefix' => '/tecnico', 'middleware' => ['auth']], function() {
    Route::get('/', 'TecnicoController@index')->name('dashboard.tecnico');
    Route::post('/criar', 'TecnicoController@criarAtendimento')->name('criar.atendimento');
});