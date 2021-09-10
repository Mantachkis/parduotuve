<?php

use App\Http\Controllers\MakerController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

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

//metodas kurio ateina('ka rodo url',[is kurio controlerio,'funkcija'])->kelias is formos action)
Route::get('maker/', [MakerController::class, 'index'])->name('maker.index');
Route::get('maker/create', [MakerController::class, 'create'])->name('maker.create');
Route::post('maker/store', [MakerController::class, 'store'])->name('maker.store');
Route::get('maker/edit/{maker}', [MakerController::class, 'edit'])->name('maker.edit');
Route::post('maker/update/{maker}', [MakerController::class, 'update'])->name('maker.update');
Route::post('maker/delete/{maker}', [MakerController::class, 'destroy'])->name('maker.destroy');

Route::get('car/', [CarController::class, 'index'])->name('car.index');
Route::get('car/create', [CarController::class, 'create'])->name('car.create');
Route::post('car/store', [CarController::class, 'store'])->name('car.store');
Route::get('car/edit/{car}', [CarController::class, 'edit'])->name('car.edit');
Route::post('car/update/{car}', [CarController::class, 'update'])->name('car.update');
Route::post('car/delete/{car}', [CarController::class, 'destroy'])->name('car.destroy');
Route::get('car/show/{car}', [CarController::class, 'show'])->name('car.show');
Route::get('car/pdf/{car}', [CarController::class, 'pdf'])->name('car.pdf');

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');