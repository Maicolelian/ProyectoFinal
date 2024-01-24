<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;

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

Route::get('/demo', [DemoController::class, 'demo'])->name('demo');

Route::prefix('v1/pelis')->group(function () 
{
    Route::get('/list', [DemoController::class, 'get']);
    Route::post('/create', [DemoController::class, 'create']);
    Route::get('/getById/{id}', [DemoController::class, 'getById']);
    Route::put('/update/{id}', [DemoController::class, 'update']);
    Route::delete('/delete/{id}', [DemoController::class, 'delete']);

});