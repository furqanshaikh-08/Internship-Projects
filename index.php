<?php include 'header.php'; ?>

<main class="hero" style="background-image:url(netflixbg.jpg) ; background-size: cover;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Unlimited movies, TV shows, and more.</h1>
        <p>Watch anywhere. Cancel anytime.</p>
        <div class="cta">
            <p>Ready to watch? Enter your email to create or restart your membership.</p>
            <form action="signup.php" method="get" class="email-form">
                <input type="email" name="email" placeholder="Email address" required>
                <button type="submit">Get Started <i class="fas fa-chevron-right"></i></button>
            </form>
        </div>
    </div>
</main>

<section class="features" style="background-image:url(netflixindex.jpg) ; background-size: cover;">
    <div class="feature">
        <div class="feature-text">
            <h2>Enjoy on your TV.</h2>
            <p>Watch on Smart TVs, Playstation, Xbox, Chromecast, Apple TV, Blu-ray players, and more.</p>
        </div>
        <div class="feature-image">
            <img src="tv.jfif" alt="TV">
        </div>
    </div>
    
    <!-- More feature sections would go here -->
</section>

<?php include 'footer.php'; ?>