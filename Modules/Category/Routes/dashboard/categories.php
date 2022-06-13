<?php

Route::group(['prefix' => 'categories'], function () {

  	Route::get('/' ,'CategoryController@index')
  	->name('dashboard.categories.index');

  	Route::get('datatable'	,'CategoryController@datatable')
  	->name('dashboard.categories.datatable');

  	Route::get('create'		,'CategoryController@create')
  	->name('dashboard.categories.create');

  	Route::post('/'			,'CategoryController@store')
  	->name('dashboard.categories.store');

  	Route::get('{id}/edit'	,'CategoryController@edit')
  	->name('dashboard.categories.edit');

  	Route::put('{id}'		,'CategoryController@update')
  	->name('dashboard.categories.update');

  	Route::delete('{id}'	,'CategoryController@destroy')
  	->name('dashboard.categories.destroy');

  	Route::get('deletes'	,'CategoryController@deletes')
  	->name('dashboard.categories.deletes');

  	Route::get('{id}','CategoryController@show')
  	->name('dashboard.categories.show');

});
