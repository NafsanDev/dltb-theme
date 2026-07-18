<?php get_header(); ?>

<!-- Full viewport hero with transparent search bar -->
<section class="hero" id="home">
  <div class="hero-body">
    <div class="pill-tag">
      <span class="pill-dot"></span>
       bus ticket in Minutes, Anytime, Anywhere.
    </div>
    <h1>DLTB CO <span>BUS,</span><br>Online <mark>Booking.</mark></h1>
    <p class="hero-intro">
      Plan your trip with ease using our DLTB Bus Co. online booking platform. Check bus schedules, compare coaches, fares, and seat reservation in just a few taps.
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
                  <input type="text" class="destination city" value="Bicol" placeholder="e.g. Bicol">                 
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
      <div class="quick-routes">
        <a class="q-tag" href="<?php echo esc_url( home_url( '/manila-to-legazpi/' ) ); ?>">Manila → Legazpi</a>
        <a class="q-tag" href="<?php echo esc_url( home_url( '/manila-to-naga/' ) ); ?>">Manila → Naga</a>        
        <a class="q-tag" href="<?php echo esc_url( home_url( '/manila-to-bicol/' ) ); ?>">Manila → Bicol</a>
      </div>
    </div>
  </div>

  <div class="hero-stats">
    <div class="stat-item">
      <span class="stat-num">140+</span>
      <span class="stat-lbl">Owned Buses</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">125</span>
      <span class="stat-lbl">Daily Trips</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">70 yrs</span>
      <span class="stat-lbl">In Service</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">20</span>
      <span class="stat-lbl">Ticket Counters</span>
    </div>
  </div>
</section>
<?php
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
        the_content(); 
    endwhile; 
endif;
?>
<?php get_footer(); ?>