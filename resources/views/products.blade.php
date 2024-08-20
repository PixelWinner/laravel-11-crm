@vite(['resources/css/products.css'])
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Продукты</h1>

        <form action="{{ route('products') }}" method="GET">
            <div class="filter-section">
                <label for="category">Категория:</label>
                <select name="category" id="category">
                    <option value="">Все категории</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <label for="min_price">Минимальная цена:</label>
                <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}">

                <label for="max_price">Максимальная цена:</label>
                <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}">

                <button type="submit">Фильтровать</button>
            </div>
        </form>
    </div>

    <div class="product-cards">
        @if ($products->isEmpty())
            <p>Продукты не найдены.</p>
        @else
            @foreach ($products as $product)
                <div class="product-card">
                    <h2>{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <p>Цена: {{ $product->price }}</p>
                    <p>
                        Категория:
                        @if($product->category)
                            {{ $product->category->name }}
                        @else
                            <em>Категория не указана</em>
                        @endif
                    </p>
                </div>
            @endforeach
        @endif
    </div>

    <div style="margin: auto 0 0 0" class="pagination-links">
        {{ $products->appends(request()->query())->links() }}
    </div>

@endsection

