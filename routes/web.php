<?php

use Illuminate\Support\Facades\Route;

$middlewares = array_merge(
    ['web'],
    (array) config('niceartisan.middleware', [])
);

Route::middleware($middlewares)->prefix('niceartisan')->group(function () {

    Route::get('/cleanhistory', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@cleanhistory')
        ->name('niceartisan.cleanHistory');
    Route::get('/cleanfavorites', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@cleanfavorites')
        ->name('niceartisan.cleanFavorites');
    Route::post('/item/{class}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@command')
        ->name('niceartisan.exec');
    Route::get('/{option?}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@show')
        ->name('niceartisan');
    Route::get('/replay/{id}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@replay')
        ->name('niceartisan.replay');

    Route::middleware(['niceartisan.ajax'])->group(function () {
        Route::post('addfav/{item}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@addFav')
            ->name('niceartisan.addFav');
        Route::post('removefav/{item}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@removeFav')
            ->name('niceartisan.removeFav');
        Route::get('commands/{command}/docs', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@showCommandDocs')
            ->name('niceartisan.command.docs');
    });

});
