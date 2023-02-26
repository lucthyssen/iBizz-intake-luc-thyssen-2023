<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\flightController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [flightController::class, 'index'])->name('home'); // root directory to home page


Route::delete('/delete/{id}', [flightController::class, 'delete'])->name('deleteSpeler'); // route to delete 1 player


Route::post('/add', [flightController::class, 'addPlayer'])->name('addSpeler'); // route to add 1 player


Route::post('/reset', [flightController::class, 'reset'])->name('reset'); // route to reset database

Route::post('/generate', [flightController::class, 'generate'])->name('generateFlights'); // route om de flights te genereren
