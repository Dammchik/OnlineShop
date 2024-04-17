@extends("layouts.app")
@section('title', 'Корзина')

@section('content')
    <table class="table">
        <tr>
            <td>Наименование</td>
            <td>Цена</td>
            <td>Количество</td>
            <td>Итого</td>
            <td>Действие</td>
        </tr>
        @foreach($cartContent as $cartProduct)

            <tr>
                <td>{{$cartProduct->get('name')}}</td>
                <td>{{$cartProduct->get('price')}}</td>
                <td>{{$cartProduct->get('quantity')}}</td>
                <td>{{$cartProduct->getPriceSum()}}</td>
                <td>
                    <form method="POST" action="{{route('cart.delete')}}">
                        @csrf

                        <input type="hidden" name="product_id" value="{{$cartProduct->get('id')}}">

                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
                <td></td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-start">
        <form action="{{route('cart.makeOrder')}}" method="POST">
            @csrf

            <button type="submit" class="btn btn-success">Оформить заказ</button>
        </form>

        <form action="{{route('cart.clear')}}" method="POST">
            @csrf

            <button type="submit" class="btn btn-warning">Очистить корзину</button>
        </form>
    </div>

    <div class="d-flex justify-content-end">
        <h3>Итого: {{\Cart::getTotal()}} руб.</h3>
    </div>
@endsection
