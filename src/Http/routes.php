<?php

Route::group(['prefix' => 'niceartisan'], function () {

	get('/', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@showMake');
	post('item/{class}', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@command');

	get('migrate', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@showMigrate');
	get('route', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@showRoute');
	get('queue', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@showQueue');
	get('handler', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@showHandler');
	get('config', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@showConfig');
	get('cache', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@showCache');
	get('miscellaneous', '\Bestmomo\NiceArtisan\Http\Controllers\NiceArtisanController@showMiscellaneous');

});