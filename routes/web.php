<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->get('/version', function () use ($router) {
    return $router->app->version();
});

//$router->group(['prefix'=>'api/v1', 'middleware' => 'cors'], function() use($router){	
$router->group(['prefix'=>'api/v1'], function() use($router){	
    $router->get('/tareas', 'TareaController@index');
    $router->post('/tareas', 'TareaController@create');
    $router->get('/tareas/{id}', 'TareaController@show');
    $router->put('/tareas/{id}', 'TareaController@update');
	$router->put('/tareas/fecha/{id}', 'TareaController@updateDate');
    $router->delete('/tareas/{id}', 'TareaController@destroy');
	
	$router->get('/usuarios', 'UsuarioController@index');
	$router->get('/usuarios/{id}', 'UsuarioController@show');
    $router->post('/usuarios', 'UsuarioController@create');
	
	$router->get('version', function () use ($router) {
		return "api rest verison 1";
	});
});

