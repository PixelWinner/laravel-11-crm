@vite(['resources/css/sidebar.css'])

@auth
    <div class="sidebar">
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Главная</a></li>

            @hasrole('admin')
            <li><a href="{{ route('getUsers') }}">Пользователи</a></li>


            <li><a href="{{ route('createProductPage') }}">Добавить товар</a></li>
            @endhasrole

            <li><a href="{{ route('products') }}">Продукты</a></li>
        </ul>
    </div>
@endauth

