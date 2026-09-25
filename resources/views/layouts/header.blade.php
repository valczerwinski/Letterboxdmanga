@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css'])
@endif

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
    }

    .site-header {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        min-height: 82px;
        padding: 0 24px;
        background: #5b1d56;
        box-sizing: border-box;
    }

    .site-header a,
    .site-header button {
        color: #fff;
        font: inherit;
        font-family: 'Signika Negative', sans-serif;
        text-decoration: none;
    }

    .site-header__buttons,
    .site-header__logo {
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .site-header__logo {
        justify-content: flex-end;
    }

    .site-header__buttons form {
        margin: 0;
    }

    .site-header__buttons button {
        padding: 0;
        border: 0;
        background: transparent;
        cursor: pointer;
    }

    .site-header__brand,
    .site-header__brand img {
        display: block;
    }

    .site-header__brand img {
        width: min(310px, 42vw);
        height: auto;
    }

    .site-header__logo img {
        display: block;
        width: 58px;
        height: 60px;
        object-fit: contain;
    }

    .site-header a:hover,
    .site-header button:hover {
        color: #fedd50;
    }

    .auth-page {
        display: flex;
        justify-content: center;
        padding: 92px 20px 120px;
        background: #fff;
        font-family: 'Signika Negative', sans-serif;
    }

    .auth-card {
        width: min(100%, 406px);
        overflow: hidden;
        border-bottom: 6px solid #5b1d56;
        border-radius: 7px;
        background: #f8f7ff;
    }

    .auth-card h1 {
        margin: 0;
        padding: 10px 20px;
        color: #fff;
        background: #5b1d56;
        font-size: 1.45rem;
        font-weight: 500;
        text-align: center;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 5px;
        padding: 40px 80px 76px;
    }

    .auth-form label {
        font-size: 0.95rem;
    }

    .auth-form input {
        width: 100%;
        height: 32px;
        padding: 5px 10px;
        border: 0;
        border-radius: 8px;
        background: #eee1ed;
        font: inherit;
        outline: none;
    }

    .auth-form input:focus {
        box-shadow: 0 0 0 2px #d4af13;
    }

    .auth-form button {
        align-self: center;
        width: 89px;
        margin-top: 20px;
        padding: 3px 12px;
        border: 0;
        border-radius: 7px;
        color: #fff;
        background: #5b1d56;
        font: inherit;
        cursor: pointer;
    }

    .auth-form button:hover {
        background: #76276f;
    }

    .auth-error {
        margin: 0 0 5px;
        color: #a32929;
        font-size: 0.85rem;
    }

    .auth-switch {
        display: block;
        margin-top: 16px;
        color: #5b1d56;
        text-align: center;
        text-decoration: none;
    }

    @media (max-width: 680px) {
        .site-header {
            min-height: 68px;
            padding: 0 12px;
        }

        .site-header__buttons,
        .site-header__logo {
            gap: 10px;
            font-size: 0.75rem;
        }

        .site-header__brand img {
            width: min(210px, 44vw);
        }

        .site-header__logo img {
            width: 42px;
            height: 46px;
        }

        .auth-page {
            padding: 52px 16px 80px;
        }

        .auth-form {
            padding: 32px 34px 58px;
        }
    }
</style>

<header class="site-header">
    <!-- Boutons à gauche -->
    <div class="site-header__buttons">
        <a href="{{ url('/') }}">Accueil</a>

        @guest
            <a href="{{ route('login') }}">Se connecter</a>
            <a href="{{ route('register') }}">S'inscrire</a>
        @else
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Déconnexion</button>
            </form>
        @endguest
    </div>

    <!-- Nom du site au centre -->
    <div class="site-header__brand">
        @if (file_exists(public_path('images/mangaboxd.svg')))
            <img src="{{ asset('images/mangaboxd.svg') }}" alt="MangaBoxD">
        @else
            <span>MANGABOXD</span>
        @endif
    </div>

    <!-- Logo à droite -->
    <div class="site-header__logo">
        @if (file_exists(public_path('images/logo.svg')))
            <img src="{{ asset('images/logo.svg') }}" alt="Logo">
        @endif
    </div>
</header>
