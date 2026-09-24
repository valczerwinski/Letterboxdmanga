@include('layouts.header')

<h1>Utilisateurs</h1>

@foreach ($users as $user)
    <div>
        <p>{{ $user->name }}</p>
        <p>{{ $user->email }}</p>

        <a href="{{ route('admin.users.delete', $user->id) }}">
            Supprimer l'utilisateur
        </a>
    </div>
@endforeach