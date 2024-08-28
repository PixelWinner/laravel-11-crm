@props(["users"])

@if ($users->isEmpty())
    <p>Нет доступных пользователей.</p>
@else
    <table class="paper-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Роли</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    {{ $user->getRoleNames()->implode(', ') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination-links">
        {{ $users->links() }}
    </div>
@endif
