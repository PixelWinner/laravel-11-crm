<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/css/pagination.css', 'resources/css/form.css', 'resources/css/reset.css', 'resources/css/toaster.css', 'resources/js/toaster.js'])
</head>
<body>

<header>
    <h3>Pixel CRM</h3>

    @auth
        <div class="user-actions">
            <span>Привет, {{ Auth::user()->name }}</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">Выйти</button>
            </form>
        </div>
    @endauth
</header>


<main>
    <x-sidebar/>
    <div class="content">
        @yield('content')
    </div>
</main>

<div id="toast-container" class="toast-container"></div>

<script>
    window.Laravel = {
        toast: {
            success: "{{ session('success') }}",
            error: "{{ session('error') }}"
        }
    };
</script>

</body>
</html>

