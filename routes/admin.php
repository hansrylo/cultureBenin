<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    Route::resource('langues', App\Http\Controllers\LangueController::class);
    Route::resource('regions', App\Http\Controllers\RegionController::class);
    Route::resource('medias', App\Http\Controllers\MediaController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('contenus', App\Http\Controllers\ContenuController::class);
    Route::resource('commentaires', App\Http\Controllers\CommentairesController::class);
    Route::resource('utilisateurs', App\Http\Controllers\UserController::class);
    Route::resource('types_media', App\Http\Controllers\TypeMediaController::class);
    Route::resource('types_contenu', App\Http\Controllers\TypeContenuController::class);
});


















