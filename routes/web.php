<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FoodRequestController;


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
    return redirect()->route('donations.index');
});

Route::get('/dashboard', [DashboardController::class, 'index']) 
->middleware(['auth', 'verified'])
->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function (){
    Route::get('/donations/create', [DonationController::class, 'create'])
    ->name('donations.create');

Route::post('/donations', [DonationController::class, 'store'])
->name('donations.store');
});


Route::get('/donations', [DonationController::class, 'index'])
->name('donations.index');


Route::middleware(['auth','admin'])->group(function(){
    Route::post('/donations/{donation}/request', [DonationController::class,'requestFood'])
    ->name('donations.request');

    Route::get('/food-requests',[FoodRequestController::class, 'index'])
->name('food_requests.index');

    Route::post('/food-requests/{foodRequest}/approve', [FoodRequestController::class,'approve'])
    ->name('food_requests.approve');

    Route::post('/food-requests/{foodRequest}/reject', [FoodRequestController::class,'reject'])
    ->name('food_requests.reject');

});

require __DIR__.'/auth.php';
