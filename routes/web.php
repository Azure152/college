<?php

use App\Http\Controllers\AsignatureController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::view('/', 'home')->name('home');

Route::controller(AsignatureController::class)->group(function () {
    Route::get('asignatures', 'list')->name('asignatures.list');
    Route::get('asignatures/create', 'create')->name('asignatures.create');
    Route::post('asignatures/create', 'store')->name('asignatures.store');
    Route::get('asignatures/{asignature}/edit', 'edit')->name('asignatures.edit');
    Route::put('asignatures/{asignature}', 'update')->name('asignatures.update');
    Route::delete('asignatures/{asignature}', 'delete')->name('asignatures.delete');
});