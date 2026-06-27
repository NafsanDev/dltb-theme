<?php get_header(); ?>

<!-- Full viewport hero with transparent search bar (same as front-page) -->
<section class="hero">
    <div class="hero-content">
        <h1><?php the_title(); ?></h1>
        <p class="hero-intro"><?php echo get_the_excerpt(); ?></p>

        <div class="transparent-search">
            <form class="search-form" action="#">
                <div class="search-field"><i class="fas fa-map-marker-alt"></i><input type="text" placeholder="From: Manila"></div>
                <div class="search-field"><i class="fas fa-flag-checkered"></i><input type="text" placeholder="To: Legazpi"></div>
                <div class="search-field"><i class="fas fa-calendar-alt"></i><input type="date"></div>
                <button type="submit" class="search-btn">Search Trips</button>
            </form>
        </div>
    </div>
</section>

<!-- Page content -->
<div class="container" style="padding: 60px 20px;">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>