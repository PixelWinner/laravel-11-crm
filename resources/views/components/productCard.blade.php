@props(["product"])

<div class="product-card">
    <h2>{{ $product->name }}</h2>

    <p>{{ $product->description }}</p>

    <p>Цена: {{ $product->price }}</p>

    <p>Количество: {{ $product->stock }}</p>

    <p>
        Категория:
        @if($product->category)
            {{ $product->category->name }}
        @else
            <em>Категория не указана</em>
        @endif
    </p>

    @auth
        @if(auth()->user()->hasRole('admin'))
            <div class="user-actions">

                <a href="{{ route('editProduct', $product) }}" class="btn btn-edit">Редактировать</a>

                <form action="{{ route('destroyProduct', $product) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить этот продукт?')">
                        Удалить
                    </button>
                </form>
            </div>
        @endif
    @endauth
</div>
