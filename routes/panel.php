<?php

use App\Http\Controllers\Authors\AuthorController;
use App\Http\Controllers\Companies\CompaniesController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\Projects\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(DefaultController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::namespace('')
    ->name('panel.')
    ->group(function () {
        Route::resource('authors', AuthorController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('companies', CompaniesController::class);
        Route::resource('users', UserController::class); 
    });


Route::patch('users/changepassword/{user}', [UserController::class, 'changePassword'])->name('users.changepassword');

