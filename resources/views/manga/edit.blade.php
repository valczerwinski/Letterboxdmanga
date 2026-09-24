@include('layouts.header')

<h1>Modifier {{ $manga->titre }}</h1>

<form method="POST" action="{{ route('manga.update', $manga->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input name="titre" value="{{ $manga->titre }}">
    <input name="author" value="{{ $manga->author }}">
    <textarea name="description">{{ $manga->description }}</textarea>
    <input name="nbr_volume" value="{{ $manga->nbr_volume }}">

    @if ($manga->image)
        <img src="{{ asset('storage/' . $manga->image) }}" alt="Illustration actuelle" width="200">
    @endif

    <label for="image">Changer l'illustration</label>
    <input id="image" type="file" name="image" accept="image/*">

    <button type="submit">Modifier</button>
</form>