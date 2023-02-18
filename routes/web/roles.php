<?php

use Illuminate\Support\Facades\Route;

Route::get('/roles', 'RoleController@index')->name('roles.index');

Route::post('/roles', 'RoleController@store')->name('roles.store');

Route::delete('/roles/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');

Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');

Route::patch('roles/{role}/update', 'RoleController@update')->name('roles.update');

Route::patch('roles/{role}/attach', 'RoleController@attach_permission')->name('roles.permissions.attach');

Route::patch('roles/{role}/detach', 'RoleController@detach_permission')->name('roles.permissions.detach');