<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::resource('todos', TodoController::class);

// Public routes

// Users api routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Todos api routes
Route::get('/todos', [TodoController::class, 'index']);
Route::post('/todos/{id}', [TodoController::class, 'show']);
Route::get('/todos/search/{description}', [TodoController::class, 'search']);

// Protected routes
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('/todos', [TodoController::class, 'store']);
    Route::post('/todos/{id}', [TodoController::class, 'update']);
    Route::post('/todos/{id}', [TodoController::class, 'destroy']);

    Route::post('/logout', [UserController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
