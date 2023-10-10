<?php

use App\Http\Controllers\Authors\AuthorController;
use App\Http\Controllers\Companies\CompaniesController;
use App\Http\Controllers\Projects\ProjectController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('authors', AuthorController::class);
Route::resource('projects', ProjectController::class);
Route::resource('companies', CompaniesController::class);