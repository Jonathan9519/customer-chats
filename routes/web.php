<?php

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
    return view('home');
});

Auth::routes();

Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/chat/{owner_id}/{user_id}', [App\Http\Controllers\ChatsController::class, 'index']);
Route::get('/messages/{owner_id}/{user_id}', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);
Route::get('/convesations', [App\Http\Controllers\ChatsController::class, 'fetchConversations']);
Route::post('/messages', [App\Http\Controllers\ChatsController::class, 'sendMessage']);
