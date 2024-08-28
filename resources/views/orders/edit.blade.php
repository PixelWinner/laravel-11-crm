@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Изменение статуса заказа</h1>

        <form action="{{ route('updateOrderStatus', $order->id) }}" method="POST">
            @csrf
            <label for="status">Статус заказа:</label>
            <select name="status" id="status">
                @foreach(App\Models\Order::statuses() as $key => $status)
                    <option value="{{ $key }}" {{ $key == $order->status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
            <button type="submit">Обновить статус</button>
        </form>
    </div>
@endsection
