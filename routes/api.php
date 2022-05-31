<?php

# Henrique - criado para resolver problema de não encontrar arquivo 
const URL_PREFIX = 'App\\Http\\Controllers\\';

use Illuminate\Support\Facades\Route;

// JWT
Route::post('login', URL_PREFIX.'AuthController@login');
Route::post('logout', URL_PREFIX.'AuthController@logout');
Route::post('refresh', URL_PREFIX.'AuthController@refresh');
Route::post('me', URL_PREFIX.'AuthController@me');

Route::group([
        'namespace' =>  URL_PREFIX.'Api',
        'middleware' => 'auth:api',
    ], function () {

    //Rota de clientes
    Route::get('clientes/{id}/filmesAlugados', 'ClienteApiController@alugados');
    Route::get('clientes/{id}/documento', 'ClienteApiController@documento');
    Route::get('clientes/{id}/telefone', 'ClienteApiController@telefone');
    Route::apiResource('clientes', 'ClienteApiController');

    //Rota de documentos dos clientes
    Route::get('documento/{id}/cliente', 'DocumentoApiController@cliente');
    Route::apiResource('documento', 'DocumentoApiController');

    //Rota de telefone dos clientes
    Route::get('telefone/{id}/cliente', 'TelefoneApiController@cliente');
    Route::apiResource('telefone', 'TelefoneApiController');

    //Rota de filmes
    Route::apiResource('filme', 'FilmeApiController');

});