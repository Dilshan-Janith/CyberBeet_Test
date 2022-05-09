<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResources([
    'task' => App\Http\Controllers\Api\TaskController::class,
    'project' => App\Http\Controllers\Api\ProjectController::class,
]);

Route::get('task_list/{id}','App\Http\Controllers\Api\TaskController@taskList');
Route::post('add_tasks','App\Http\Controllers\Api\ProjectController@addTask');