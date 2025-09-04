<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iFairy – Your Magical Educational Fairy</title>

    {{-- Importing fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400..900;1,400..900&family=Open+Sans:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">

    {{-- Custom CSS Styles --}}
    @vite(['resources/css/ifairy-welcome.css', 'resources/js/ifairy-welcome.js'])
</head>
<body>
    {{-- Header --}}
    <header class="site-header">
        <div class="container">
            <h1 class="logo-title">iFairy</h1>
            <nav class="main-nav">
                <a href="#about">About Us</a>
                <a href="#how-it-works">How it Works</a>
                <a href="#safety">Safety</a>
            </nav>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        {{-- Hero Section --}}
        <section class="hero-section container">
            <h2 class="hero-title">
                Discover the Magic of Learning with Why the Fairy!
            </h2>
            <p class="hero-subtitle">
                A personalized AI fairy companion that answers your child's every question and guides them through the wonders of knowledge in a safe and magical way.
            </p>
            <div class="hero-cta">
                <a href="{{ route('register') }}" class="btn btn--primary">Sign Up for Free</a>
                <a href="{{ route('login') }}" class="btn btn--secondary">Log In</a>
            </div>
            <img src="/img/why-hero-illustration.png" alt="An illustration of a friendly fairy surrounded by books and stars" class="hero-illustration">
        </section>

        {{-- About Us Section --}}
        <section id="about" class="section section--light-bg">
            <div class="container">
                <h3 class="section-title" style="color: var(--color-primary-purple-darker);">Who is Why the Fairy?</h3>
                <p class="section-subtitle">
                    Why is your child's new magical companion, designed especially for children aged 5-9. Born from pure curiosity, Why turns every "why?" into a fascinating educational adventure. We help build confidence, foster critical thinking skills, and nurture a lifelong love for learning.
                </p>
            </div>
        </section>

        {{-- How it Works Section --}}
        <section id="how-it-works" class="section">
            <div class="container">
                <h3 class="section-title" style="color: var(--color-primary-blue-dark);">How Does It Work?</h3>
                <div class="steps-grid">
                    {{-- Step 1 --}}
                    <div class="step-card step-card--purple">
                        <span class="step-number">1</span>
                        <h4 class="step-card__title">Sign Up</h4>
                        <p class="step-card__description">Create a secure profile for your child, choosing their special iFairy nickname.</p>
                    </div>
                    {{-- Step 2 --}}
                    <div class="step-card step-card--blue">
                        <span class="step-number">2</span>
                        <h4 class="step-card__title">Ask a Question</h4>
                        <p class="step-card__description">Your child talks to Why naturally, asking about anything that sparks their curiosity.</p>
                    </div>
                    {{-- Step 3 --}}
                    <div class="step-card step-card--green">
                        <span class="step-number">3</span>
                        <h4 class="step-card__title">Learn & Explore</h4>
                        <p class="step-card__description">Why responds with magical stories, interactive activities, and supports your child's development.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Safety Section --}}
        <section id="safety" class="section section--safety">
            <div class="container">
                <h3 class="section-title">Our Priority: Safety & Privacy</h3>
                <p class="section-subtitle">
                    We understand how crucial your child's safety is in the digital world. That's why iFairy is built from the ground up with the highest standards of data privacy and security. Our platform is compliant with the UK Children's Code and other key regulations. We never collect excessive data, and all interactions are designed to protect and support your child's growth.
                </p>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2024 iFairy. All rights reserved.</p>
            <nav class="footer-nav">
                <a href="/privacy-policy">Privacy Policy</a>
                <a href="/terms-of-service">Terms of Service</a>
            </nav>
        </div>
    </footer>
</body>
</html>