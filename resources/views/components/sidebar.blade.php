@vite(['resources/css/sidebar.css'])

@auth
    <div class="sidebar">
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Главная</a></li>

            @hasrole('admin')
            <li><a href="{{ route('users') }}">Пользователи</a></li>


            <li><a href="{{ route('storeProductPage') }}">Добавить товар</a></li>

            <li><a href="{{ route('categories') }}">Категории</a></li>
            @endhasrole

            @hasanyrole('admin|seller')
            <li><a href="{{ route('allOrders') }}">Все заказы</a></li>
            @endhasanyrole

            <li><a href="{{ route('products') }}">Продукты</a></li>

            <li><a href="{{ route('orders') }}">Заказы</a></li>

            <li><a href="{{ route('cartPage') }}">Корзина</a></li>
        </ul>
    </div>
@endauth

