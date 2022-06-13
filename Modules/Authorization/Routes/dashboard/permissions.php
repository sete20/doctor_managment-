<?php

Route::group(['prefix' => 'permissions' , 'middleware' => [ 'dashboard.auth','permission:dashboard_access' ]], function () {

  	Route::get('/' ,'PermissionController@index')
  	->name('dashboard.permissions.index');

  	Route::get('datatable'	,'PermissionController@datatable')
  	->name('dashboard.permissions.datatable');

  	Route::get('create'		,'PermissionController@create')
  	->name('dashboard.permissions.create');

  	Route::post('/'			,'PermissionController@store')
  	->name('dashboard.permissions.store');

  	Route::get('{id}/edit'	,'PermissionController@edit')
  	->name('dashboard.permissions.edit');

  	Route::put('{id}'		,'PermissionController@update')
  	->name('dashboard.permissions.update');

  	Route::delete('{id}'	,'PermissionController@destroy')
  	->name('dashboard.permissions.destroy');

  	Route::get('deletes'	,'PermissionController@deletes')
  	->name('dashboard.permissions.deletes');

  	Route::get('{id}','PermissionController@show')
  	->name('dashboard.permissions.show');

});
