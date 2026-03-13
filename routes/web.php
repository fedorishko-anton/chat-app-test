<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,ChatController};

Route::get('/', function () {
  return view('welcome');
})->name('index');

Route::controller(AuthController::class)->group(function () {
  Route::get('/login', 'showLogin')->name('login');
  Route::post('/login', 'login');
  
  Route::get('/register', 'showRegister')->name('register');
  Route::post('/register', 'register');
});
Route::middleware('auth')->group(function () {
  Route::post('/logout', [AuthController::class,'logout'])->name('logout');
  
  Route::controller(ChatController::class)->prefix('chat')->group(function () {
    Route::get('/', 'showAllChats')->name('chat');
    Route::get('/{receiver}', 'showUserChat')->name('chat.single');
    Route::post('/{receiver}/send', 'sendMessage')->name('chat.send-message');
  });
});