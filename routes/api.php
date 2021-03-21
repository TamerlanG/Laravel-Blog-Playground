<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resources([
    'posts' => \App\Http\Controllers\PostController::class,
    'category' => \App\Http\Controllers\CategoryController::class,
    'tags' => \App\Http\Controllers\TagController::class
]);

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group(['prefix' => 'staff'], function () {
    Route::post('/register', [\App\Http\Controllers\StaffController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\StaffController::class, 'login']);

    Route::group(['middleware' => ['auth:staff', 'scopes:staff']], function(){
        Route::get('/', [\App\Http\Controllers\StaffController::class, 'index']);
    });
});

Route::group(['prefix' => 'writer'], function () {
    Route::post('/register', [\App\Http\Controllers\WriterController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\WriterController::class, 'login']);

    Route::group(['middleware' => ['auth:writer', 'scopes:writer']], function(){
        Route::get('/', [\App\Http\Controllers\WriterController::class, 'index']);
    });
});

Route::group(['prefix' => 'reader'], function () {
    Route::post('/register', [\App\Http\Controllers\ReaderController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\ReaderController::class, 'login']);

    Route::group(['middleware' => ['auth:reader', 'scopes:reader']], function(){
        Route::get('/', [\App\Http\Controllers\ReaderController::class, 'index']);
    });
});
