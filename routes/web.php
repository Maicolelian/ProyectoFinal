<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelisController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [PelisController::class, 'home'])->name('home');

Route::prefix('v1/pelis')->group(function () 
{
    Route::get('/list', [PelisController::class, 'get']);
    Route::post('/create', [PelisController::class, 'create']);
    Route::get('/getById/{id}', [PelisController::class, 'getById']);
    Route::put('/update/{id}', [PelisController::class, 'update']);
    Route::delete('/delete/{id}', [PelisController::class, 'delete']);

});

