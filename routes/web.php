<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

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
    return redirect()->route('login');
});

Route::get('/init_redirect', function () {
    /** @var User $user */
    
    $user = Auth::user();

    if ($user->hasRole('admin')) {
        return redirect()->route('panel.index');
    } else {
        return redirect()->route('report.dashboard');
    }
});