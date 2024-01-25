<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/demo', [PelisController::class, 'demo'])->name('demo');

Route::prefix('v1/pelis')->group(function () 
{
    Route::get('/list', [PelisController::class, 'get']);
    Route::post('/create', [PelisController::class, 'create']);
    Route::get('/getById/{id}', [PelisController::class, 'getById']);
    Route::put('/update/{id}', [PelisController::class, 'update']);
    Route::delete('/delete/{id}', [PelisController::class, 'delete']);

});