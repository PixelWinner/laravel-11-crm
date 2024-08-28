@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Все заказы пользователей</h1>

        @if ($orders->isEmpty())
            <p>Нет доступных заказов.</p>
        @else
            <table class="paper-table">
                <thead>
                <tr>
                    <th>Номер заказа</th>
                    <th>Пользователь</th>
                    <th>Статус</th>
                    <th>Товары</th>
                    <th>Сумма</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <ul>
                                @foreach ($order->orderItems as $item)
                                    <li>{{ $item->product->name }} ({{ $item->quantity }} шт.)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $order->total }}</td>
                        <td>
                            <form class="user-actions" style="flex-direction: column" action="{{ route('updateOrderStatus', $order->id) }}" method="POST">
                                @csrf
                                <select name="status" id="status">
                                    @foreach(App\Models\Order::statuses() as $key => $status)
                                        <option value="{{ $key }}" {{ $key == $order->status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit">Обновить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pagination-links">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
