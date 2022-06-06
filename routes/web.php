<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

//HomeController
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ProfileController
Route::get('/profile', [App\Http\Controllers\User\UserController::class, 'view'])->name('profile');
Route::get('/profile-update', [App\Http\Controllers\User\UserController::class, 'updateShow'])->name('profile.update');
Route::post('/profile-update', [App\Http\Controllers\User\UserController::class, 'update'])->name('post.profile.update');

//NoteController
Route::get('/note-create', [App\Http\Controllers\Note\NoteController::class, 'createShow'])->name('get.note.create');
Route::post('/note-create', [App\Http\Controllers\Note\NoteController::class, 'create'])->name('post.note.create');
Route::get('/note-update/{id}', [App\Http\Controllers\Note\NoteController::class, 'updateShow'])
    ->name('get.note.update')
    ->where('id', '[0-9]+');;
Route::post('/note-update/{id}', [App\Http\Controllers\Note\NoteController::class, 'update'])
    ->name('post.note.update')
    ->where('id', '[0-9]+');;
Route::get('/note/remove/{id}',  [App\Http\Controllers\Note\NoteController::class, 'remove'])
    ->name('note.remove')
    ->where('id', '[0-9]+');
