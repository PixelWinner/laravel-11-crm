@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактирование продукта</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form class="paper-form" action="{{ route('updateProduct', $product) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Название продукта</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Цена</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Категория</label>
                <select name="category_id" id="category_id">
                    <option value="">Без категории</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Сохранить изменения</button>
        </form>
    </div>
@endsection
