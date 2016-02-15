<?php

Route::get('', [
	'as' => 'admin.home',
	function ()
	{
		$content = 'Define your dashboard here.';
		return Admin::view($content, 'Dashboard');
	}
]);

Route::get('/send_products', '\App\Http\Controllers\AdminController@getSendProducts');
