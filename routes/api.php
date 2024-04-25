<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/comment', [CommentController::class, 'index']);
Route::get('/content', [ContentController::class, 'index']);
Route::post('/comment', [CommentController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::controller(UserController::class)->group(function () {
        Route::get('/user/{id}',                'show');
        Route::put('/user/{id}',                'update')->name('user.update');
        Route::put('/user/email/{id}',          'email')->name('user.email');
        Route::put('/user/password/{id}',       'password')->name('user.password');
        Route::put('/user/image/{id}',          'image')->name('user.image');
        Route::delete('/user/{id}',             'destroy');
        Route::get('/profile',                  'showProfile');
    });

    Route::controller(ContentController::class)->group(function () {
        Route::get('/content/{id}',             'show');
        Route::post('/content',                 'store');
        Route::put('/content/{id}',             'update');
        Route::delete('/content/{id}',          'destroy');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::get('/comment/{id}',             'show');
        Route::put('/comment/{id}',             'update');
        Route::delete('/comment/{id}',          'destroy');
    });

    Route::get('/profile/show',  [ProfileController::class, 'show']);
});
