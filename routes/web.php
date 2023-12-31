<?php

use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use App\Http\Livewire\TasksComponent;
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
Route::group(['middleware' => ['auth']], function() {
    Route::get('/tasks', TasksComponent::class)->name('task');
});

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
