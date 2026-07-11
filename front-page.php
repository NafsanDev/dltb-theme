<?php get_header(); ?>

<!-- Full viewport hero with transparent search bar -->
<section class="hero" id="home">
  <div class="hero-body">
    <div class="pill-tag">
      <span class="pill-dot"></span>
      Go Anywhere, Book Instantly.
    </div>
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
      <div class="quick-routes">
        <span class="q-tag">Manila → Legazpi</span>
        <span class="q-tag">Manila → Naga</span>        
        <span class="q-tag">Manila → Bicol</span>
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
<h2>Your Static Section Goes Here.</p>
<?php get_footer(); ?>