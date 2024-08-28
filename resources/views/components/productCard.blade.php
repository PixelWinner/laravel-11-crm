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

        <form class="cart-actions" action="{{ route('storeCart', $product) }}" method="POST">
            @csrf
            <label for="quantity">Количество:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}">
            <button type="submit" class="btn btn-add-to-cart">Добавить в корзину</button>
        </form>

        @if(auth()->user()->hasRole('admin'))
            <div class="user-actions" style="justify-content: center">
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
</div>
