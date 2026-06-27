<?php get_header(); ?>

<section class="hero" style="min-height: 70vh;">
    <div class="hero-content">
        <h1>404 – Page Not Found</h1>
        <p class="hero-intro">Oops! The page you are looking for does not exist.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-cta">Go Back Home</a>
    </div>
</section>

<?php get_footer(); ?>