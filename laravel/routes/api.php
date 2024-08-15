<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TesteController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [AuthController::class, 'login']);

// Todas as rotas protegidas pelo sanctum (:
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::get('teste', [TesteController::class, 'index'])->middleware('ability:teste-index');
    Route::post('logout', [AuthController::class, 'logout']);
});


// ability = precisa de UM (do token) para autorizar
// abilities = precisa de TODOS (do token) para autorizar


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