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
Use App\Http\Controllers\UserController;

//Inicio - Filtra todos itens
Route::get('/',  [UserController::class, 'index']);

//Pagina de edição/cadastro ( com ou sem ID respectivamente)
Route::get('/user/{id?}', [UserController::class, 'read']);

//inlcusao ou alteraçãodo usuário
Route::post('/users/{id?}', [UserController::class, 'store']);

//exclusão de um usuário
Route::delete('/users/{id}', [UserController::class, 'destroy']);
