@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Корзина</h1>

        @if($cartItems->isEmpty())
            <p>Корзина пуста.</p>
        @else
            <table class="paper-table">
                <thead>
                <tr>
                    <th>Название продукта</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>{{ $cartItem->quantity }}</td>
                        <td>{{ $cartItem->product->price }}</td>
                        <td>
                            <form action="{{ route('destroyCart', $cartItem) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <form action="{{ route('storeOrder') }}" method="POST">
                @csrf
                <button type="submit">Оформить заказ</button>
            </form>
        @endif
    </div>
@endsection
