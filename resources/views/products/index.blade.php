@vite(['resources/css/products.css'])
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Продукты</h1>

        <form action="{{ route('products') }}" method="GET">
            <div class="filter-section">

                <div class="form-group">
                    <label for="category">Категория:</label>
                    <select name="category" id="category">
                        <option value="">Все категории</option>
                        <option value="none" {{ request('category') == 'none' ? 'selected' : '' }}>Без категории
                        </option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="min_price">Минимальная цена:</label>
                    <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}">
                </div>


                <div class="form-group">
                    <label for="max_price">Максимальная цена:</label>
                    <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}">
                </div>

                <div class="form-group">
                    <label for="name">Название продукта:</label>
                    <input type="text" name="name" id="name" value="{{ request('name') }}"
                           placeholder="Введите название">
                </div>

                <button type="submit">Фильтровать</button>
            </div>
        </form>
    </div>

    <div class="product-cards">
        @if ($products->isEmpty())
            <p>Продукты не найдены.</p>
        @else
            @foreach ($products as $product)
                <x-productCard :product="$product"/>
            @endforeach
        @endif
    </div>

    <div style="margin: auto 0 0 0" class="pagination-links">
        {{ $products->appends(request()->query())->links() }}
    </div>
@endsection
