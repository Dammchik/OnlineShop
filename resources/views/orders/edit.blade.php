@extends('layouts.app')

@section('title', 'Изменение заказа')

@section('content')
    <div class="card">
        <div class="card-header">
            Изменение заказа
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('orders.update', $order->id) }}">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="mb-3">
                    <label for="description" class="form-label">Статус заказа</label>
                    <select class="form-select" name="status">
                        @foreach($statuses as $status)
                            <option name="{{$status->value}}" {{$status == $order->status ? 'selected="true"':''}}>{{$status->value}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Изменить</button>
                <a href="#">
                    <button type="button" class="btn btn-primary">Отмена</button>
                </a>
            </form>
        </div>
    </div>
@endsection
