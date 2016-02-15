@extends('layout.main')

@section('title', 'Техподдержка')

@section('content_head')
    Техподдержка
@endsection

@section('content')
    <div id="feedback-desc">В этом разделе Вы можете отправить вопрос в нашу техподдержку.<br><b>Среднее время ответа составляет 24 часа.</b>
        <br>
        Ответ будет отображён на этой странице.
    </div>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if (Session::has('errors'))
        <div class="alert alert-danger">{{ Session::get('errors') }}</div>
    @endif

    <form method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group"><label for="question">Вопрос:</label><textarea name="text" id="question" placeholder="Вопрос..." class="form-control"></textarea></div>
        <div class="form-group"><button type="submit" class="btn btn-success">Отправить</button></div>
    </form>
@endsection