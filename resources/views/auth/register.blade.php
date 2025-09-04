<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iFairy - Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Caveat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ifairy-auth.css') }}"> {{-- Podłączamy nasz niestandardowy CSS --}}
</head>
<body>
    <div class="auth-container">

        <div class="auth-card">

            <div class="auth-header">
                <a href="/" class="auth-logo-link">
                    <img src="{{ asset('img/ifairy_logo.png') }}" alt="iFairy Logo" class="auth-logo">
                </a>
                <h2 class="auth-title">Create your account</h2>
                <p class="auth-subtitle">Join iFairy to start learning adventures.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="form-group-actions">
                    <a class="auth-link-login" href="{{ route('login') }}">Already have an account? Sign in</a>
                    <button type="submit" class="btn-submit">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
