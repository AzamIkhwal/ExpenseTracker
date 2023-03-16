<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// All Expenses
Route::match(['get', 'post'], '/index', [ExpenseController::class, 'index'])->middleware('auth');

// Store Expense Data
Route::post('/store', [ExpenseController::class, 'store'])->middleware('auth');

// Delete Expense
Route::delete('delete/{data}', [ExpenseController::class, 'delete'])->middleware('auth');

// Show Register/Create Form
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'create']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);