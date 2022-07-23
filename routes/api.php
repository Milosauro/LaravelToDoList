<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Task;

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

// Route::get('tasks', "TaskController@index"); // List tasks
Route::get('tasks', [TaskController::class, 'index']);

// Route::post('tasks', "TaskController@store"); // Create Post
Route::post('tasks', [TaskController::class, 'store']);

// Route::get('tasks/{id}', "TaskController@show"); // Detail of Post
Route::get('tasks/{id}', [TaskController::class, 'show']);

// Route::put('tasks/{id}', "TaskController@update"); // Update Post
Route::put('tasks/{id}', [TaskController::class, 'update']);

// Route::delete('tasks/{id}', "TaskController@destroy"); // Delete Post
Route::delete('tasks/{id}', [TaskController::class, 'destroy']);

Route::delete('tasks/', [TaskController::class, 'clear']);