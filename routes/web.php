<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DeveloperController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Developer;

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

Auth::routes();

Route::prefix('')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('game')->group(function () {

        Route::get('/', [GameController::class, 'index'])->name('games');

        Route::get('/create', [GameController::class, 'create'])->name('game.create');

        Route::get('/{id}', [GameController::class, 'show'])->name('game.show');
        
        Route::get('/edit/{id}', [GameController::class, 'modify'])->name('game.edit');

        Route::patch('/update/{id}', [GameController::class, 'update'])->name('game.update');

        Route::post('/store', [GameController::class, 'store'])->name('game.store');

        Route::delete('/delete/{id}', [GameController::class, 'destroy'])->name('game.delete');
    });

    Route::prefix('developer')->group(function () {

        Route::get('/create', [DeveloperController::class, 'create'])->name('developer.create');

        Route::get('/{id}', [DeveloperController::class, 'show'])->name('developer.show');

        Route::get('/edit/{id}', [DeveloperController::class, 'modify'])->name('developer.edit');

        Route::patch('/update/{id}', [DeveloperController::class, 'update'])->name('developer.update');
        
        Route::post('/store', [DeveloperController::class, 'store'])->name('developer.store');
        
        Route::delete('/delete/{id}', [DeveloperController::class, 'destroy'])->name('developer.delete');
    });

    Route::get('/code', [DeveloperController::class, 'index'])->name('code');

    Route::get('/profile', [UserController::class, 'show'])->name('profile');

    Route::get('transaction/history', [TransactionController::class, 'index'])->name('history');

    Route::get('transaction/detail/{id}', [TransactionController::class, 'show'])->name('detail');

    // Route::get('/login', [AuthController::class, 'login'])->name('login');

    // Route::get('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/carts', [CartController::class, 'index'])->name('cart');

    Route::post('carts/store', [CartController::class, 'store'])->name('cart.store');

    Route::post('reviews/store', [ReviewController::class, 'store'])->name('review.store');

    Route::delete('review/delete', [ReviewController::class, 'destroy'])->name('review.delete');

    Route::post('transaction/store', [TransactionController::class, 'store'])->name('transaction.store');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::patch('/profile/update', [UserController::class, 'update'])->name('profile.update');

    Route::delete('carts/delete', [CartController::class, 'destroy'])->name('carts.delete');

    Route::get('/transaction/code/{id}', [TransactionController::class, 'code'])->name('code');
});

