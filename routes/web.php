<?php

use Illuminate\Support\Facades\Route;

$customMiddleware = config('niceartisan.middleware');

$middlewares = ['web'];

if ($customMiddleware) {
    if (is_string($customMiddleware)) {
        $middlewares[] = $customMiddleware;
    } 
    elseif (is_array($customMiddleware)) {
        $middlewares = array_merge($middlewares, $customMiddleware);
    }
}

Route::middleware($middlewares)->group(function () {
    Route::group(['prefix' => 'niceartisan'], function () {
        Route::post('/item/{class}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@command')
            ->name('niceartisan.exec');
        Route::get('/{option?}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@show')
            ->name('niceartisan');

        Route::group(['middleware' => 'niceartisan.ajax'], function () {
            Route::post('addfav/{item}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@addFav')
                ->name('niceartisan.addFav');
            Route::post('removefav/{item}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@removeFav')
                ->name('niceartisan.removeFav');
            Route::get('commands/{command}/docs', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@showCommandDocs')
                ->name('niceartisan.command.docs');
        });
    });
});