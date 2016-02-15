<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="imagetoolbar" content="no">
    <meta name="msthemecompatible" content="no">
    <meta name="cleartype" content="on">
    <meta name="google" value="notranslate">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-tooltip" content="">
    <title>Денежный отзыв - @section('title') Главная @show</title>
    <meta name="description" content="Денежный отзыв. Проект для успешных людей.">
    <meta name="keywords" content="деньги, отзывы, заработок, успех, счастье, радость">
    {{--<link rel="stylesheet" href="assets/styles/bootstrap.css">--}}
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" href="assets/styles/main.css">
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="assets/vendor/jquery/jquery.mask.min.js"></script>
    <script src="assets/scripts/script.js"></script>
</head>

<body>
<nav id="top-navbar" class="navbar">
    <div class="container">
        <div id="navbar">
            <div id="logo"></div>
            <div id="stat">Товаров для оценки: {{$user_need_products}}</div>
        </div>
    </div>
</nav>
<div id="main-container" class="container">
    <div class="row">
        <div class="col-sm-2 sidebar">
            <ul id="left-menu" class="nav nav-sidebar">
                <li class="@if ($active_page=='index') active @endif"><a href="/">Главная</a></li>
                <li class="@if ($active_page=='balance') active @endif"><a href="/balance">Баланс</a></li>
                <li class="@if ($active_page=='feedback') active @endif"><a href="/feedback">Техподдержка</a></li>
                <li class="@if ($active_page=='settings') active @endif"><a href="/settings">Настройки</a></li>
                <li class="@if ($active_page=='logout') active @endif"><a href="/logout">Выход</a></li>
            </ul>
            <div id="balance">Баланс:
                <div id="balance-sum">{!! $user_balance !!}</div>
            </div>
            <div id="best-worker">Лучший участник сегодня:
                <div>{{$best_member}}</div>
            </div>
        </div>
        <div class="col-sm-10" id="main-content">
            <div class="panel panel-primary">
                <div class="panel-heading">@yield('content_head')</div>
                <div class="panel-body">
                    @yield('content')
                </div>
                <div class="panel-footer">
                    Всего участников в проекте: {{$members}}
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>