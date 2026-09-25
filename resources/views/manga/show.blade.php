@include('layouts.header')

<style>
    .manga-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: #fff;
        font-family: 'Signika Negative', sans-serif;
    }

    .manga-banner {
        display: flex;
        gap: 24px;
        margin-bottom: 24px;
    }

    .manga-banner img {
        width: 180px;
        height: 250px;
        flex: 0 0 180px;
        border-radius: 5px;
        object-fit: cover;
    }

    .manga-info {
        flex: 1;
    }

    .manga-info .manga-description {
        margin-top: 22px;
    }

    .manga-info-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 20px;
    }

    .manga-title,
    .manga-note-label,
    .manga-meta,
    .manga-description {
        color: #000;
        font-family: Arial, sans-serif;
    }

    .manga-title {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
    }

    .manga-note-label {
        font-size: 16px;
        font-weight: 700;
        white-space: nowrap;
    }

    .manga-meta,
    .manga-description {
        font-size: 14px;
        line-height: 1.4;
    }

    .manga-volume-panel {
        width: min(100%, 560px);
        margin: 0 auto;
    }

    .volume-button {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 10px;
        padding: 7px 10px;
        border: 1px solid #b7a3b5;
        border-radius: 5px;
        color: #000;
        background: #d3d3d3;
        cursor: pointer;
        font-family: Arial, sans-serif;
        transition: 0.2s;
    }

    .volume-button.is-noted {
        background: #a9a9a9;
    }

    .volume-button:hover {
        color: #fff;
        background: #1687d9;
    }

    .volume-button select {
        min-width: 92px;
        border: 0;
        border-radius: 4px;
        background: transparent;
        font: inherit;
        cursor: pointer;
    }

    .manga-comment-label {
        margin-top: 12px;
        font-family: Arial, sans-serif;
    }

    .manga-volume-panel textarea {
        min-height: 70px;
        padding: 8px;
        border: 1px solid #b7a3b5;
        border-radius: 5px;
        resize: vertical;
    }

    .manga-submit {
        align-self: flex-end;
        padding: 7px 14px;
        border: 0;
        border-radius: 5px;
        color: #fff;
        background: #5b1d56;
        cursor: pointer;
    }

    .manga-error {
        margin: 0 0 8px;
        color: #a32929;
        font-size: 0.85rem;
    }

    @media (max-width: 768px) {
        .manga-banner {
            flex-direction: column;
        }

        .manga-banner img {
            width: min(100%, 180px);
        }
    }
</style>

<main class="manga-detail-container">
    <div class="manga-banner">
        @if ($manga->image)
            <img
                src="{{ asset('storage/' . $manga->image) }}"
                alt="Illustration de {{ $manga->titre }}"
                width="300"
            >
        @endif
        <div class="manga-info">
            <div class="manga-info-header">
                <h1 class="manga-title">{{ $manga->titre }}</h1>
                <span class="manga-note-label">
                    Note : {{ $noteMoyenne !== null ? number_format($noteMoyenne, 1) . ' / 5' : 'Aucune note' }}
                </span>
            </div>
            <p class="manga-meta"><strong>Nombre de volumes :</strong> {{ $manga->nbr_volume }}</p>
            <div class="manga-description">
                <p><strong>Auteur :</strong> {{ $manga->author }}</p>
                <p>{{ $manga->description }}</p>
            </div>
        </div>
    </div>

    <div class="manga-volume-panel">
            @auth
                <form method="POST" action="{{ route('manga.review', ['id' => $manga->id]) }}">
                    @csrf

                    @for ($volumeNumber = 1; $volumeNumber <= $manga->nbr_volume; $volumeNumber++)
                        @php($volumeNote = $volumeReviews[$volumeNumber]->notes ?? null)
                        <label class="volume-button {{ $volumeNote !== null ? 'is-noted' : '' }}" for="notes_{{ $volumeNumber }}">
                            <span>Volume {{ $volumeNumber }}</span>
                            <select id="notes_{{ $volumeNumber }}" name="notes[{{ $volumeNumber }}]" required>
                                <option value="">Note</option>
                                @foreach ([0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5] as $note)
                                    <option value="{{ $note }}" @selected((string) $volumeNote === (string) $note)>
                                        {{ $note }} / 5
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        @error("notes.{$volumeNumber}")
                            <p class="manga-error">{{ $message }}</p>
                        @enderror
                    @endfor

                    <label class="manga-comment-label" for="Commentaire">Commentaire général</label>
                    <textarea id="Commentaire" name="Commentaire"></textarea>
                    <button class="manga-submit" type="submit">Enregistrer mes notes</button>
                </form>
            @else
                <p><a href="{{ route('login') }}">Connectez-vous</a> pour noter les volumes.</p>
            @endauth
    </div>

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
</main>