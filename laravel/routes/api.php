<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class);

// // Rota para listar todos os usuários (index)
// Route::get('users', [UserController::class, 'index']);

// // Rota para criar um novo usuário (store)
// Route::post('users', [UserController::class, 'store']);

// // Rota para exibir um usuário específico (show)
// Route::get('users/{user}', [UserController::class, 'show']);

// // Rota para atualizar um usuário específico (update)
// Route::put('users/{user}', [UserController::class, 'update']);

// // Rota para excluir um usuário específico (destroy)
// Route::delete('users/{user}', [UserController::class, 'destroy']);