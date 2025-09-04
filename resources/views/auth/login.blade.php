<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iFairy - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Caveat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ifairy-auth.css') }}"> {{-- Podłączamy nasz niestandardowy CSS --}}
</head>
<body>
    <div class="auth-container">

        <div class="auth-card">

            <div class="auth-header">
                {{-- Logo iFairy (zastępuje lub usuwa x-slot name="logo") --}}
                <a href="/" class="auth-logo-link">
                    <img src="{{ asset('img/ifairy_logo.png') }}" alt="iFairy Logo" class="auth-logo">
                </a>

                {{-- Tytuł strony --}}
                <h2 class="auth-title">Welcome back!</h2>
                <p class="auth-subtitle">Sign in to your account.</p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="auth-status-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email Address --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="form-group-checkbox">
                    <label for="remember_me" class="checkbox-label">
                        <input id="remember_me" type="checkbox" name="remember" class="form-checkbox">
                        <span class="checkbox-text">Remember me</span>
                    </label>
                </div>

                <div class="form-group-actions"> {{-- Nowa klasa dla elementów akcji --}}
                    @if (Route::has('password.request'))
                        <a class="forgot-password-link" href="{{ route('password.request') }}">Forgot your password?</a>
                    @endif

                    <button type="submit" class="btn-submit">Sign in</button>
                </div>
            </form>

            <div class="auth-footer">
                Don’t have an account? <a href="{{ route('register') }}" class="auth-link-register">Create one</a>
            </div>
        </div>
    </div>
</body>
</html>
