@include('layouts.header')

<main class="auth-page">
    <section class="auth-card" aria-labelledby="login-title">
        <h1 id="login-title">Connexion</h1>

        <form class="auth-form" method="POST" action="{{ route('login') }}">
            @csrf

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

            <button type="submit">OK</button>
        </form>

        <a class="auth-switch" href="{{ route('register') }}">Créer un compte</a>
    </section>
</main>
