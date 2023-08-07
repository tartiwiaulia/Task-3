<?php

use App\Http\Controllers\ApiTodoController;
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

Route::get('getList', [ApiTodoController::class, 'getList']);
Route::post('postList', [ApiTodoController::class, 'postList']);
Route::delete('deleteList/{id}', [ApiTodoController::class, 'deleteList']);
Route::post('updateList/{id}', [ApiTodoController::class, 'updateList']);
Route::get('showList/{id}', [ApiTodoController::class, 'showList']);