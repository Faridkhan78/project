<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('adduser');
});

Route::view('register','register')->name('register');
Route::post('registerSave',[UserController::class,'register'])->name('registerSave');

Route::get('viewUser',[UserController::class,'viewUserall'])->name('viewuser');

Route::delete('delete/{id}',[UserController::class,'deleteUser'])->name('delete');


Route::post('/update/{id}',[UserController::class,'updateUser'])->name('update');
Route::get('/updatePage/{id}',[UserController::class,'updatePage'])->name('update.page');



