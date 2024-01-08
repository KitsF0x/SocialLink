<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get("/", [HomeController::class, 'index'])->name("home.index");

Route::get("/auth/register", [AuthController::class, 'registerForm'])->name("auth.registerForm");
Route::post("/auth/register", [AuthController::class, 'register'])->name("auth.register");
Route::get("/auth/login", [AuthController::class, 'loginForm'])->name("auth.loginForm");
Route::post("/auth/login", [AuthController::class, 'login'])->name("auth.login");
Route::post('/auth/logout', [AuthController::class, 'logout'])->name("auth.logout");

Route::get('/profile/my', [ProfileController::class, 'edit'])->name("profile.edit");
Route::put('/profile/my', [ProfileController::class, 'update'])->name("profile.update");