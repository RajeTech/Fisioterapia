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

Auth::routes();
Route::get('/', function($value='')
{
	return view('auth.login');
})->name('site');


Route::group(['middleware' => 'auth'], function(){
	Route::get('/home', 'HomeController@index')->name('home');

	Route::prefix('pacientes')->group(function(){
		Route::get('/','Modulos\Pacientes@index');
		Route::any('/cadastrarEditar/{id?}','Modulos\Pacientes@cadastrarEditar');
		Route::any('/paciente/{id?}','Modulos\Pacientes@paginaPaciente');
		Route::any('/excluir/{id?}','Modulos\Pacientes@excluir');
	});
	Route::prefix('guias')->group(function(){
		Route::get('/','Modulos\GuiasFisioterapia@index');
		Route::any('/cadastrarEditar/{id?}','Modulos\GuiasFisioterapia@cadastrarEditar');

		Route::any('/exibirGuia/{id}/{exibir?}/{segundavia?}','Modulos\GuiasFisioterapia@gerarExibirPeca');

		Route::any('/excluir/{id?}','Modulos\GuiasFisioterapia@excluir');
	});
	Route::prefix('prontuarios')->group(function(){
		Route::get('/','Modulos\Prontuario@index');
		Route::any('/cadastrarEditar/{id?}','Modulos\Prontuario@cadastrarEditar');
		Route::any('/excluir/{id?}','Modulos\Prontuario@excluir');
	Route::any('/salvarDescricao/{id}','Modulos\Prontuario@salvarDescricao');
	
		Route::any('/exibir/{id}/{exibir?}','Modulos\Prontuario@gerarExibirPeca');
	});

	Route::prefix('atendimentos')->group(function(){
		Route::get('/','Modulos\Atendimentos@index');
		Route::any('/cadastrarEditar/{id?}','Modulos\Atendimentos@cadastrarEditar');
		Route::any('/excluir/{id?}','Modulos\Atendimentos@excluir');
		Route::any('/relatorio','Modulos\Atendimentos@gerarExibirPeca');

	});

	Route::any('/buscaRapida/{tipo}','Modulos\Configuracoes@buscaRapida');
	Route::prefix('medico')->group(function(){
		Route::get('/','Modulos\Pacientes@index');

	});

	Route::prefix('configuracoes')->group(function(){
		Route::get('/','Modulos\Configuracoes@index');

		Route::any('/cadastrarEditarDadosClinica','Modulos\Configuracoes@cadastrarEditarDadosClinica');

		Route::post('/cadastrarEditarUsuario/{id?}','Modulos\Configuracoes@cadastrarEditarUsuario');

		Route::get('/deletarUsuario/{id?}','Modulos\Configuracoes@deletarUsuario');
	});

	Route::prefix('paciente')->group(function(){
		Route::get('/','Modulos\Pacientes@index');
	});

});