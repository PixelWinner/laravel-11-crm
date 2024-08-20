@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Главная страница</h1>

        <ul>
            <li><strong>Laravel версия:</strong> {{ app()->version() }}</li>

            <li><strong>PHP версия:</strong> {{ PHP_VERSION }}</li>

            <li><strong>Сервер:</strong> {{ $_SERVER['SERVER_SOFTWARE'] ?? 'Информация недоступна' }}</li>

            <li><strong>PostgreSql версия:</strong> {{ \DB::selectOne('SELECT VERSION() AS version')->version }}</li>
        </ul>
    </div>
@endsection
