<?php get_header(); ?>

<!-- Full viewport hero with transparent search bar (same as front-page) -->
<section class="hero" id="home">
  <div class="hero-body">
    <h1>DLTB <span>BUS,</span><br>Online <mark>Booking.</mark></h1>
    <p class="hero-intro">
      DLTB Online Booking is just a few clicks. Enjoy comfortable, reliable, affordable rides, and experience seamless travel across the Philippines with the DLTB Co.
    </p>
    <div class="transparent-search bus-search">
        <div class="search-form">
            <div class="first-section">
              <div class="search-field">
                  <i class="fas fa-map-marker-alt"></i>
                  <input type="text" class="origin city" value="Manila" placeholder="e.g. Manila">                 
              </div>
              <button type="button" class="swap">⇄</button>
              <div class="search-field">
                  <i class="fas fa-flag-checkered"></i>
                  <input type="text" class="destination city" value="Legazpi" placeholder="e.g. Legazpi">                 
              </div>
            </div>
            <div class="second-section">
              <div class="search-field date-field">
                  <i class="fas fa-calendar-alt"></i>
                  <input type="date" class="date" value="">
              </div>
              <div class="search-field number-field">
                <input type="number" class="passengers" min="1" value="2">
                <div class="arrow-container">
                  <button type="button" class="arrow increase">▲</button>
                  <button type="button" class="arrow decrease">▼</button>
                </div>
              </div>
            </div>
            <button type="submit" class="search-btn search">Book Ticket</button>
        </div>
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