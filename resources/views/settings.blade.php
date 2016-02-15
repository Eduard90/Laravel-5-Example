@extends('layout.main')

@section('title', 'Настройки')

@section('content_head')
    Настройки
@endsection

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <form class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="lang" class="col-sm-2 control-label">Язык:</label>
            <div class="col-sm-10">
                <select class="form-control" id="lang" name="lang">
                    <option value="ru">Русский</option>
                    <option disabled="true">English</option>
                    <option disabled="true">Deutsch</option>
                    <option disabled="true">Italiano</option>
                    <option disabled="true">Español</option>
                    <option disabled="true">Français</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="currency" class="col-sm-2 control-label">Валюта:</label>
            <div class="col-sm-10">
                <select class="form-control" id="currency" name="currency">
                    <option value="rub" @if ($user->currency=='rub') selected @endif>Рубли</option>
                    <option value="usd" @if ($user->currency=='usd') selected @endif>Доллары</option>
                    <option value="eur" @if ($user->currency=='eur') selected @endif>Евро</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </div>
    </form>
@endsection