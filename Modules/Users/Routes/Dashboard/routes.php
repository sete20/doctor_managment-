<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admins'], function () {

  	Route::get('/' ,'AdminController@index')
  	->name('dashboard.admins.index');

  	Route::get('datatable'	,'AdminController@datatable')
  	->name('dashboard.admins.datatable');

  	Route::get('create'		,'AdminController@create')
  	->name('dashboard.admins.create');

  	Route::post('/'			,'AdminController@store')
  	->name('dashboard.admins.store');

  	Route::get('{id}/edit'	,'AdminController@edit')
  	->name('dashboard.admins.edit');

  	Route::put('{id}'		,'AdminController@update')
  	->name('dashboard.admins.update');

  	Route::delete('{id}'	,'AdminController@destroy')
  	->name('dashboard.admins.destroy');

  	Route::get('deletes'	,'AdminController@deletes')
  	->name('dashboard.admins.deletes');

  	Route::get('{id}','AdminController@show')
  	->name('dashboard.admins.show');

});
