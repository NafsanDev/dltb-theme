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

<!-- Features -->
<section class="section-features">
  <div class="container">
    <p class="sec-tag-light" style="color: var(--sage);">Why Choose DLTB CO</p>
    <h2 class="sec-title-light">Travel with <em>Confidence</em></h2>
    <div class="features-row">
      <div class="feature-item">
        <div class="feat-icon">⚡</div>
        <div class="feat-title">Instant Confirmation</div>
        <p class="feat-text">Get your e-ticket the moment payment goes through — no waiting, no uncertainty.</p>
      </div>
      <div class="feature-item">
        <div class="feat-icon">💺</div>
        <div class="feat-title">Choose Your Seat</div>
        <p class="feat-text">Pick your preferred seat in advance for every route and schedule.</p>
      </div>
      <div class="feature-item">
        <div class="feat-icon">🔒</div>
        <div class="feat-title">Secure Payments</div>
        <p class="feat-text">Card, GCash, PayMaya — all transactions are encrypted and secure.</p>
      </div>
      <div class="feature-item">
        <div class="feat-icon">📱</div>
        <div class="feat-title">Go Paperless</div>
        <p class="feat-text">Your e-ticket lives on your phone. No printing needed — just show and board.</p>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section-faq" style="padding: 80px 0;">
    <div class="container">
        <div class="sec-tag">Common Questions</div>
        <h2 class="sec-title">Frequently Asked</h2>
        <div class="faq-wrap">
            <div class="faq-item">
                <div class="faq-q" >
                How do I book a DLTB ticket online? <span class="faq-icon">+</span>
                </div>
                <div class="faq-a">Use the search form to select your route and date, choose a seat, enter your details, then pay. Your e-ticket arrives instantly by email or SMS.</div>
            </div>
            <div class="faq-item">
                <div class="faq-q" >
                Do I need to create an account? <span class="faq-icon">+</span>
                </div>
                <div class="faq-a">No account needed. Simply provide your contact information when booking.</div>
            </div>
            <div class="faq-item">
                <div class="faq-q" >
                What payment methods are accepted? <span class="faq-icon">+</span>
                </div>
                <div class="faq-a">DLTB accepts credit/debit cards (Visa, Mastercard), online banking, and e-wallets including GCash and PayMaya.</div>
            </div>
            <div class="faq-item">
                <div class="faq-q" >
                Can I cancel or change my reservation? <span class="faq-icon">+</span>
                </div>
                <div class="faq-a">Yes, depending on the route. Check the cancellation policy at checkout. Best to cancel in advance for a refund.</div>
            </div>
            <div class="faq-item">
                <div class="faq-q" >
                Do I need to print my e-ticket? <span class="faq-icon">+</span>
                </div>
                <div class="faq-a">No printing required. Show your digital e-ticket with a valid ID when boarding the bus.</div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>