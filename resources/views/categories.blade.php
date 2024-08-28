@vite(['resources/css/categories.css'])
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Категории</h1>

        <form class="paper-form" action="{{ route('storeCategory') }}" method="POST">
            @csrf
            <label for="name">Название категории</label>
            <input type="text" name="name" id="name" required>
            <button type="submit">Добавить категорию</button>
        </form>

        <h2>Список категорий</h2>

        <ul class="categories-list">
            @foreach ($categories as $category)
                <li>
                    {{ $category->name }}
                    <form action="{{ route('destroyCategory', $category) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить категорию?')">
                            Удалить
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>

        <div class="pagination-links">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
