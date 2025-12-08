<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MediaUploadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Media migration endpoint (protected by token)
Route::post('/media/upload', [MediaUploadController::class, 'upload']);
