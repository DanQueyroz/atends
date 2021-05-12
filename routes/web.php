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

Route::group(['namespace' => 'Gestor', 'prefix' => '/gestor', 'middleware' => ['auth']], function() {
    Route::get('/', 'GestorController@index')->name('dashboard.gestor');

    // Tipos de Atendimrnto
    Route::get('/tipos/atendimentos', 'gestorController@getTiposAtendimentos')->name('tipos.atendimentos');
    Route::post('/criar/tipo', 'gestorController@criarTipoAtendimento')->name('criar.tipo.atendimento');
    Route::post('/desativar/tipo', 'gestorController@desativarTipoAtendimento')->name('desativar.tipo.atendimento');
    Route::post('/excluir/tipo', 'gestorController@excluirTipoAtendimento')->name('excluir.tipo.atendimento');

    // Técnicos
    Route::get('/tecnicos', 'gestorController@getTecnicos')->name('tecnicos');
    Route::post('/criar/tecnico', 'gestorController@criarTecnico')->name('criar.tecnico');
    Route::post('/desativar/tecnico', 'gestorController@desativarTecnico')->name('desativar.tecnico');
    Route::post('/excluir/tecnico', 'gestorController@excluirTecnico')->name('excluir.tecnico');
});