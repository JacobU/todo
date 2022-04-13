<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    echo 'Hello BlueSky';
});

Route::get('/todo/{id}', [TodoController::class, 'single']);

Route::get('/todos', [TodoController::class, 'list']);

Route::post('/todo', [TodoController::class, 'add']);

Route::patch('todo/{id}', [TodoController::class, 'edit']);

Route::delete('todo/{id}', [TodoController::class, 'delete']);