<?php

Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard');
Admin::menu('App\User')->icon('fa-users');
Admin::menu('App\Product')->icon('fa-list');
Admin::menu('App\UserProduct')->icon('fa-list');
Admin::menu('App\Feedback')->icon('fa-rss');
Admin::menu('App\Setting')->icon('fa-folder-open');

Admin::menu()->url('send_products')->label('Раздача товаров');