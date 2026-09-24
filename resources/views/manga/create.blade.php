@include('layouts.header')

<h1>create</h1>
<form method="POST" action="{{ route('create') }}" enctype="multipart/form-data">
    @csrf

    <input name="titre">
    <input name="author">
    <textarea name="description"></textarea>
    <input name="nbr_volume">
    <label for="image">Illustration du manga</label>
    <input id="image" type="file" name="image" accept="image/*">

    <button type="submit">Créer</button>
</form>