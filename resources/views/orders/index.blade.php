@extends("layouts.app")
@section('title', 'Список товаров')

@section('content')
    <table class="table">
        <tr>
            <td>Дата создания</td>
            <td>Пользователь</td>
            <td>Статус</td>
            <td>Товары</td>
            <td>Действие</td>
        </tr>
        @forelse($orders as $order)
            <tr>
                <td>{{$order->created_at->format("d.m.Y")}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->status}}</td>
                <td>
                    <table class="w-100 table table hover">
                        <tr>
                            <td>Название</td>
                            <td>Цена</td>
                            <td>Количество</td>
                            <td>Итого</td>
                        </tr>
                        @foreach($order->orderProducts as $orderProduct)
                            <tr>
                                <td>{{$orderProduct->name  }}</td>
                                <td>{{$orderProduct->price}}</td>
                                <td>{{$orderProduct->quantity}}</td>
                                <td>{{$orderProduct->total_price}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
                <td>

                    <a class="btn btn-primary" href="{{route('orders.edit', $order)}}">Изменить</a>

                </td>
                @empty
            <tr>
                <td colspan="4">Нет заказов</td>
            </tr>
        @endforelse
    </table>
@endsection
