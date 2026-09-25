@include('layouts.header')

<style>
    .home-page {
        min-height: calc(100vh - 82px);
        background: #fff;
        font-family: 'Signika Negative', sans-serif;
    }

    .home-hero {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 310px;
        background: #321f45 url('{{ asset('images/image_de_fond.svg') }}') center / cover no-repeat;
    }

    .home-filters {
        display: flex;
        gap: 12px;
        max-width: 1160px;
        margin: 20px auto 0;
        padding: 0 24px;
    }

    .home-filter {
        min-width: 92px;
        padding: 3px 18px;
        border: 1px solid #16105e;
        border-radius: 999px;
        color: #16105e;
        background: #fff;
        font: inherit;
        text-align: center;
        text-decoration: none;
    }

    .home-filter--active {
        background: #fedd50;
    }

    .home-content {
        display: grid;
        grid-template-columns: 166px minmax(0, 1fr);
        gap: 16px;
        width: 100%;
        min-height: calc(100vh - 450px);
        margin: 4px 0 0;
        padding: 0;
        background: #fff;
    }

    .home-left-column {
        display: flex;
        flex-direction: column;
    }

    .home-status-filters {
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: center;
        margin-top: 54px;
    }

    .home-sidebar {
        flex: 1;
        margin-top: 110px;
        margin-bottom: 24px;
        overflow: hidden;
        border-radius: 0 7px 7px 0;
        color: #fff;
        background: #5b1d56;
    }

    .home-sidebar h2 {
        margin: 0;
        padding: 18px 12px;
        font-size: 1rem;
        font-weight: 500;
        text-align: center;
    }

    .home-top-manga {
        display: grid;
        grid-template-columns: 68px 1fr;
        gap: 10px;
        align-items: center;
        padding: 10px 12px;
        color: #fff;
        text-decoration: none;
    }

    .home-top-manga__image,
    .manga-card__image--empty {
        display: block;
        width: 68px;
        height: 98px;
        border-radius: 6px;
        background: #fff;
    }

    .home-top-manga__image {
        object-fit: cover;
    }

    .home-top-manga p {
        margin: 0;
        font-size: 0.82rem;
    }

    .home-rating {
        color: #fff;
        letter-spacing: 0.03em;
    }

    .manga-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 24px 28px;
        padding: 16px 24px 32px 8px;
        border-radius: 8px 0 0 0;
        background: #5b1d56;
    }

    .manga-card {
        min-width: 0;
        padding: 16px 0 0;
        color: #fff;
    }

    .manga-card__image,
    .manga-card__image--empty {
        width: 100%;
        aspect-ratio: 0.72;
        border-radius: 6px;
    }

    .manga-card__image {
        display: block;
        object-fit: cover;
    }

    .manga-card__image--empty {
        background: #fff;
    }

    .manga-card a {
        color: inherit;
        text-decoration: none;
    }

    .manga-card h2,
    .manga-card p {
        margin: 2px 0 0;
        font-size: 0.9rem;
        font-weight: 400;
    }

    @media (max-width: 900px) {
        .manga-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 680px) {
        .home-hero {
            min-height: 210px;
        }

        .home-filters {
            padding-right: 14px;
            padding-left: 14px;
        }

        .home-content {
            grid-template-columns: 1fr;
            min-height: 0;
        }

        .home-status-filters {
            flex-direction: row;
            justify-content: center;
            margin-top: 20px;
        }

        .home-sidebar {
            margin-top: 0;
            margin-bottom: 24px;
        }

        .manga-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            padding: 0 12px 20px;
        }
    }
</style>

<main class="home-page">
    <section class="home-hero" aria-label="Illustration Mangaboxd"></section>

    <nav class="home-filters" aria-label="Filtres des mangas">
        <a
            class="home-filter {{ request('sort') === 'az' ? 'home-filter--active' : '' }}"
            href="{{ url('/') }}?sort=az"
        >
            A-Z
        </a>
    </nav>

    <div class="home-content">
        <div class="home-left-column">
            <div class="home-status-filters" aria-label="Filtres de statut">
                <span class="home-filter">Terminer</span>
                <span class="home-filter">En cours</span>
            </div>

            <aside class="home-sidebar">
                <h2>Les mangas les mieux notés</h2>

                @foreach ($mangasLesMieuxNotes as $manga)
                    <a class="home-top-manga" href="{{ route('manga.show', ['id' => $manga->id]) }}">
                        @if ($manga->image)
                            <img class="home-top-manga__image" src="{{ asset('storage/' . $manga->image) }}" alt="">
                        @else
                            <span class="home-top-manga__image"></span>
                        @endif
                        <span>
                            <p>{{ $manga->titre }}</p>
                            <p class="home-rating">★★★★★</p>
                        </span>
                    </a>
                @endforeach
            </aside>
        </div>

        <section class="manga-grid" aria-label="Liste des mangas">
            @foreach ($mangas as $manga)
                <article class="manga-card">
                    <a href="{{ route('manga.show', ['id' => $manga->id]) }}">
                        @if ($manga->image)
                            <img class="manga-card__image" src="{{ asset('storage/' . $manga->image) }}" alt="Illustration de {{ $manga->titre }}">
                        @else
                            <span class="manga-card__image--empty"></span>
                        @endif
                        <h2>{{ $manga->titre }}</h2>
                        <p class="home-rating">★★★★★</p>
                    </a>
                </article>
            @endforeach
        </section>
    </div>
</main>
