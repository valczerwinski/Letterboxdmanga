@include('layouts.header')

<h1>Administration</h1>

<a href="{{ route('view_create') }}">
    Créer un manga
</a>

<h2>Gérer les mangas</h2>

@foreach ($mangas as $manga)
    <p>
        {{ $manga->titre }}
        <a href="{{ route('admin.manga.edit', ['id' => $manga->id]) }}">
            Modifier
        </a>

        <a href="{{ route('delete', ['id' => $manga->id]) }}">
            Supprimer
        </a>
    </p>
@endforeach

<a href="{{ route('admin.users') }}">
    Voir les utilisateurs
</a>
