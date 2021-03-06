<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaffleController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::post('raffle/process', [RaffleController::class, 'process'])->name('raffle.process');
    Route::get('raffle/draw/{id}', [RaffleController::class, 'draw'])->name('raffle.draw');
    Route::get('raffle/reset/{id}', [RaffleController::class, 'reset'])->name('raffle.reset');
    Route::get('raffle/view/{id}', [RaffleController::class, 'view'])->name('raffle.view');
    Route::get('raffle/results/{id}', [RaffleController::class, 'results'])->name('raffle.results');
    Route::get('raffle/export/{id}', [RaffleController::class, 'export'])->name('raffle.export');
    Route::resource('raffle', RaffleController::class);
});
