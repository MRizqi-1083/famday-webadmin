<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\EventsControllers;

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

Route::get('/', [AuthControllers::class, 'index'])->name('login');
Route::post('auth/login', [AuthControllers::class, 'login'])->name('auth');

Route::get('events/list', [EventsControllers::class, 'index'])->name('eventlist');
Route::post('events/create', [EventsControllers::class, 'create'])->name('eventcreate');
