@include('layouts.header')

<h1>{{ $manga->titre }}</h1>

@if ($manga->image)
    <img
        src="{{ asset('storage/' . $manga->image) }}"
        alt="Illustration de {{ $manga->titre }}"
        width="300"
    >
@endif

<p><strong>Auteur :</strong> {{ $manga->author }}</p>
<p><strong>Description :</strong> {{ $manga->description }}</p>
<p><strong>Volumes :</strong> {{ $manga->nbr_volume }}</p>

<p>
    <strong>Note :</strong>
    {{ $noteMoyenne !== null ? number_format($noteMoyenne, 1) . ' / 5' : 'Aucune note' }}
</p>

@auth
    <h2>Noter les volumes</h2>

    <form method="POST" action="{{ route('manga.review', ['id' => $manga->id]) }}">
        @csrf

        @for ($volumeNumber = 1; $volumeNumber <= $manga->nbr_volume; $volumeNumber++)
            <label for="notes_{{ $volumeNumber }}">
                Volume {{ $volumeNumber }}
            </label>
            <select id="notes_{{ $volumeNumber }}" name="notes[{{ $volumeNumber }}]" required>
                <option value="">Choisir une note</option>
                @foreach ([0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5] as $note)
                    <option
                        value="{{ $note }}"
                        @selected((string) ($volumeReviews[$volumeNumber]->notes ?? '') === (string) $note)
                    >
                        {{ $note }} / 5
                    </option>
                @endforeach
            </select>
            @error("notes.{$volumeNumber}")
                <p>{{ $message }}</p>
            @enderror
        @endfor

        <label for="Commentaire">Commentaire</label>
        <textarea id="Commentaire" name="Commentaire"></textarea>
        @error('Commentaire')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Enregistrer ma note</button>
    </form>
@else
    <p>
        <a href="{{ route('login') }}">Connectez-vous</a>
        pour donner une note.
    </p>
@endauth

<h2>Commentaires</h2>

@forelse ($reviews as $review)
    <article>
        <p>
            <strong>{{ $review->user?->name ?? 'Utilisateur' }}</strong>
        </p>

        @if ($review->Commentaire)
            <p>{{ $review->Commentaire }}</p>
        @endif
    </article>
@empty
    <p>Aucun commentaire pour le moment.</p>
@endforelse

<a href="{{ url('/') }}">Retour à la homepage</a>
