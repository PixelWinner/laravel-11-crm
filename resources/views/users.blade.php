@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список пользователей</h1>

        <x-usersTable :users='$users'/>
    </div>
@endsection
