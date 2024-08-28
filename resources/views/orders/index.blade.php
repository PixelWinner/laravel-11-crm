@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Мои заказы</h1>

        @if ($orders->isEmpty())
            <p>У вас нет заказов.</p>
        @else
            <table class="paper-table">
                <thead>
                <tr>
                    <th>Номер заказа</th>
                    <th>Статус</th>
                    <th>Товары</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <ul>
                                @foreach ($order->orderItems as $item)
                                    <li>{{ $item->product->name }} ({{ $item->quantity }} шт.)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $order->total }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Пагинация -->
            <div class="pagination-links">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
