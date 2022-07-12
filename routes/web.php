<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerContact;

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

Route::group(['prefix' => '/'], function () {
    Route::get('/', [ControllerContact::class, 'contacts'])->name('contacts');
    Route::post('/register', [ControllerContact::class, 'registerContact'])->name('registerContact');
    Route::post('/edit', [ControllerContact::class, 'editContact'])->name('editContact');
    Route::get('/delete/{id}', [ControllerContact::class, 'deleteContact'])->name('deleteContact');
});
