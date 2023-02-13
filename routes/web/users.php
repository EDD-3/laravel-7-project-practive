<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/users/{user}/profile', 'UserController@show')->name('user.profile.show');

    Route::put('/users/{user}/update', 'UserController@update')->name('user.profile.update');
});

Route::middleware(['role:admin', 'auth'])->group(function () {
    Route::delete('/users/{user}/destroy', 'UserController@destroy')->name('users.destroy');

    Route::get('/users', 'UserController@index')->name('users.index');

    Route::patch('/users/{user}/attach', 'UserController@attach')->name('user.role.attach');

    Route::patch('/users/{user}/detach', 'UserController@detach')->name('user.role.detach');
});

Route::middleware(['can:view,user'])->group(function () {

    Route::get('/users/{user}/profile', 'UserController@show')->name('user.profile.show');
});
