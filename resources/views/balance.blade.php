@extends('layout.main')

@section('title', 'Баланс')

@section('content_head')
    Баланс
@endsection

@section('content')
    <div class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="lang" class="col-sm-2 control-label">Вывести на:</label>
            <div class="col-sm-10">
                <select class="form-control" id="lang" name="lang">
                    <option value="ru">Qiwi</option>
                    <option disabled="true">VISA</option>
                    <option disabled="true">Яндекс.Деньги</option>
                    <option disabled="true">WebMoney</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="currency" class="col-sm-2 control-label">Номер телефона:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" autocomplete="off">
            </div>
        </div>
    </div>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <form method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div>Ваш баланс: {{$user_balance}}</div><button id="withdraw" disabled="true" class="btn btn-success form-control">Вывести</button>
    </form>
    <div id="withdraw-desc">Минимальная сумма для вывода на {{$date_format}} составляет {{$need_balance}} рублей.</div>
@endsection