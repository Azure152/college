<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnnotationController;
use App\Http\Controllers\AnnotationFileController;
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

Route::controller(ActivityController::class)->group(function () {
    Route::get('activities', 'list')->name('activities.list');
    Route::get('activities/create', 'create')->name('activities.create');
    Route::post('activities/create', 'store')->name('activities.store');
    Route::get('activities/{activity}', 'show')->name('activities.show');
    Route::get('activities/{activity}/edit', 'edit')->name('activities.edit');
    Route::put('activities/{activity}', 'update')->name('activities.update');
    Route::delete('activities/{activity}', 'delete')->name('activities.delete');
});

Route::controller(AnnotationController::class)->group(function () {
    Route::prefix('activites/{activity}/')->group(function () {
        Route::get('annotations/create', 'create')->name('annotations.create');
        Route::post('annotations/create', 'store')->name('annotations.store');
    });

    Route::get('annotations/{id}', 'show')->name('annotations.show');
    Route::get('annotations/{annotation}/edit', 'edit')->name('annotations.edit');
    Route::put('annotations/{annotation}', 'update')->name('annotations.update');
    Route::delete('annotations/{annotation}', 'delete')->name('annotations.delete');


});

Route::controller(AnnotationFileController::class)->group(function () {
    Route::prefix('annotations/{annotation}/files/')->group(function () {
        Route::get('create', 'create')->name('annotations.file.create');
        Route::post('create', 'store')->name('annotations.file.store');
    });

    Route::delete('annotations/files/{annotationFile}', 'delete')->name('annotations.file.delete');
    Route::get('annotations/files/{annotationFile}', 'download')->name('annotations.file.download');
});