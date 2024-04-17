@extends("layouts.app")
@section('title', 'Список товаров')

@section('content')
    @can("products.create")
        <a class="btn btn-primary" href="{{route('products.create')}}">Создать </a>
    @endcan
    <table class="table">
        <tr>
            <td>Наименование</td>
            <td>Артикул</td>
            <td>Цена</td>
            <td>Описание</td>
            <td>Автор</td>
            <td>Действие</td>
        </tr>
        @forelse($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->article}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->description}}</td>
                <td>
                    {{$product->user->name}} ({{$product->user->email}})
                </td>
                <td>
                    <a class="btn btn-secondary" href="{{route('products.show', $product)}}">Перейти</a>

                    <form method="POST" action="{{route('cart.add')}}">
                        @csrf

                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button type="submit" class="btn btn-primary">В корзину</button>
                    </form>

                    @can("products.update")
                        <a class="btn btn-primary" href="{{route('products.edit', $product)}}">Изменить</a>
                    @endcan
                    @can("products.delete")
                        <form method="POST" action="{{route('products.destroy', $product)}}">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Нет товаров</td>
            </tr>
        @endforelse
    </table>
@endsection
