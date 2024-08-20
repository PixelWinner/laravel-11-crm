@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создание нового продукта</h1>

        <form class="paper-form" action="{{ route('createProduct') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Название продукта</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                       value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                          name="description">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="manufacturer">Производитель</label>
                <input type="text" class="form-control @error('manufacturer') is-invalid @enderror" id="manufacturer"
                       name="manufacturer" value="{{ old('manufacturer') }}" required>
                @error('manufacturer')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Цена</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price"
                       name="price" value="{{ old('price') }}" required>
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Количество на складе</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
                       value="{{ old('stock') }}" required>
                @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Категория</label>
                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id">
                    <option value="">Выберите категорию</option>
                    <!-- Пример статического вывода категорий. В реальном проекте лучше динамически загружать категории -->
                    @foreach(\App\Models\Category::all() as $category)
                        <option
                            value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Создать продукт</button>
        </form>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
