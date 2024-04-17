@extends("layouts.app")
@section('title', 'Просмотр товара')

@section('content')
    <h1> {{ $product->name }}</h1>
    <p>Артикул: {{$product->article}}</p>
    <p>Цена: {{$product->price}}</p>
    <p>
        Описание:
        @if($product->description)
            {{$product->description}}
            @else
            Нет описания
        @endif
    </p>
@endsection
