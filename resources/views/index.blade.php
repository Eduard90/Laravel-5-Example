@extends('layout.main')

@section('title', 'Главная')

@section('content_head')
    Главная
@endsection

@section('content')
    <div id="products">
        @foreach($products as $product)
            <div data-id="{{$product->id}}" class="product-item">
                <div class="product-image">
                    <img src="{{$product->image_url}}">
                </div>
                <div class="product-title">{{$product->title}}</div>
                <a href="#" class="product-link">Написать отзыв</a>
            </div>
        @endforeach
    </div>

    <div id="do-description">
        @if ($user_need_products > 0)
            Выберите товар для написания отзыва.
        @else
            В данный момент нет товаров.
        @endif
    </div>
    <div id="review-popup" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">&times;</span></button>
                    <h4>Отзыв</h4></div>
                <div class="modal-body">
                    <div id="product-info">
                        <div id="product-image"><img></div>
                        <div id="product-title"></div>
                        <div id="product-link"></div>
                    </div>
                    <div id="product-review">
                        <textarea placeholder="Отзыв" rows="3" class="form-control" name="review"></textarea>
                        <div>Вы получите за этот отзыв: 0 руб.</div>
                    </div>
                </div>
                <div class="modal-footer"><button data-dismiss="modal" class="btn btn-default">Закрыть</button><button class="btn btn-success" id="post_review">Отправить</button></div>
            </div>
        </div>
    </div>
@endsection