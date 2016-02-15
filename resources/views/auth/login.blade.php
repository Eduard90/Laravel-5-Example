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
        <title>Денежный отзыв - Вход.</title>
        <meta name="description" content="Денежный отзыв. Проект для успешных людей.">
        <meta name="keywords" content="деньги, отзывы, заработок, успех, счастье, радость">
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap-theme.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/styles/login.css">

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-3">
                        <form method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-login">
                                <h4>Денежный отзыв</h4>
                                <h4>Войти</h4><input placeholder="Логин" type="text" name="email" class="form-control input-sm chat-input"><br><input name="password" placeholder="Пароль" type="password" class="form-control input-sm chat-input"><br>
                                <div class="wrapper"><span class="group-btn"><button type="submit" class="btn btn-primary btn-md">Войти&nbsp;<i class="fa fa-sign-in"></i></button></span></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    </head>

</html>