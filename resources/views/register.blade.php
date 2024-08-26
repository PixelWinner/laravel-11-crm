@extends('layouts.app')

@section('content')
    <div>
        <h1>Регистрация</h1>
        <form class="paper-form" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <div style="color: red;">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <div style="color: red;">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
                @if ($errors->has('password'))
                    <div style="color: red;">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation">Подтвердите пароль:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                @if ($errors->has('password_confirmation'))
                    <div style="color: red;">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                @endif
            </div>

            <button type="submit">Зарегистрироваться</button>

            <a href="{{ route('login') }}">Войти</a>
        </form>
    </div>
@endsection
