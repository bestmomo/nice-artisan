<?php

Route::group(['prefix' => config('commands.settings.route', 'niceartisan')], function () {
    Route::get('/{option?}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@show')
        ->name('niceartisan');
    Route::post('item/{class}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@command')
        ->name('niceartisan.exec');
});
