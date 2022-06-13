<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('clients/datatable'	,'ClientController@datatable')
        ->name('clients.datatable');

    Route::get('clients/deletes'	,'ClientController@deletes')
        ->name('clients.deletes');

    Route::delete('clients/delete/{client}/attachments/{collection}/{media}', 'ClientController@deleteAttachment')
        ->name('clients.attachment.delete');

    Route::get('clients/send-notification'	,'ClientController@notificationView')
        ->name('clients.notification.view');

    Route::post('clients/send-notification'	,'ClientController@sendNotification')
        ->name('clients.notification.send');

    Route::get('clients/switch/{id}/{action}', 'ClientController@switcher')->name('clients.switch');

    Route::resource('clients','ClientController')->names('clients');
});
