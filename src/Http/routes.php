<?php

Route::group(['prefix' => 'niceartisan'], function () {
    Route::get('/{option?}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@show');
    Route::post('item/{class}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@command');
});