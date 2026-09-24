@include('layouts.header')

<main class="auth-page">
    <section class="auth-card" aria-labelledby="register-title">
        <h1 id="register-title">S'inscrire</h1>

        <form class="auth-form" method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name">Pseudo :</label>
            <input id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <p class="auth-error">{{ $message }}</p>
            @enderror

            <label for="email">Email :</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror

            <label for="password">Mot de passe :</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror

            <label for="password_confirmation">Confirmer le mot de passe :</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>

            <button type="submit">OK</button>
        </form>

        <a class="auth-switch" href="{{ route('login') }}">Déjà un compte ? Se connecter</a>
    </section>
</main>
