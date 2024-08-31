@vite(['resources/css/products.css'])
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Все заказы пользователей</h1>

        <form action="{{ route('allOrders') }}" method="GET">
            <div class="filter-section">
                <div class="form-group">
                    <label for="user_email">Почта пользователя:</label>
                    <input type="text" name="user_email" id="user_email" value="{{ request('user_email') }}">
                </div>

                <div class="form-group">
                    <label for="status">Статус заказа:</label>
                    <select name="status" id="status">
                        <option value="">Все статусы</option>
                        @foreach(App\Models\Order::statuses() as $key => $status)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit">Фильтровать</button>
            </div>
        </form>

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
                                    <li>
                                        @if ($item->product)
                                            {{ $item->product->name }} ({{ $item->quantity }} шт.)
                                        @else
                                            <em>Продукт удалён</em> ({{ $item->quantity }} шт.)
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $order->total }}</td>
                        <td>
                            <form class="user-actions" style="flex-direction: column"
                                  action="{{ route('updateOrderStatus', $order->id) }}" method="POST">
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
                {{ $orders->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection
