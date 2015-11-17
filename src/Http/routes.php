<?php

Route::group(['prefix' => 'niceartisan'], function () {
    get('/{option?}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@show');
    post('item/{class}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@command');
});