@extends('layouts.app')

@section('content')
    <div>
        <h1>Вход</h1>
        <form class="paper-form" action="{{ route('login') }}" method="POST">
            @csrf
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

            @if ($errors->has('credentials'))
                <div style="color: red;">
                    {{ $errors->first('credentials') }}
                </div>
            @endif

            <button type="submit">Войти</button>

            <a href="{{ route('register') }}">Зарегистрироваться</a>
        </form>

    </div>
@endsection
