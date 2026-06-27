<!-- CTA -->
<section class="section-cta" id="booking">
  <div class="container">
    <div class="cta-inner">
      <p class="sec-tag" style="color: var(--teal);font-size: 0.9rem;">DLTB Online Booking</p>
      <h2>Ready to <em>Hit the Road?</em></h2>
      <p>Seats fill up fast. Secure yours in under 2 minutes.</p>

      <div class="search-box bus-search">
        <div class="search-card">
          <div class="search-fields">
            <div class="field">
              <label>From</label>
              <input type="text" class="origin" placeholder="e.g. Manila" value="Manila">
               
            </div>
            <button type="button" class="swap">⇄</button>
            <div class="field">
              <label>To</label>
              <input type="text" class="destination" placeholder="e.g. Legazpi" value="Legazpi">
               
            </div>
            <div class="field">
              <label>Travel Date</label>
              <input type="date" class="date">
            </div>
          </div>
          <input type="number" class="passengers" min="1" value="1">
          <div class="arrow-container">
            <button type="button" class="arrow up">▲</button>
            <button type="button" class="arrow down">▼</button>
          </div>
          <button class="btn-cta btn-search-cta search">Book Your Trip Now</button>
        </div>
      </div>

    </div>
  </div>
</section>
</main>

<footer id="site-footer">
  <div class="container">
    <div class="footer-top">
      <div class="footer-brand">
        <div class="footer-logo-text">DLTB <em>CO</em></div>
        <p class="footer-tagline">Connecting the Philippines through fast, reliable, and affordable bus travel since 1954.</p>
      </div>
      <div class="footer-cols">
        <div class="footer-col">
          <h4>Navigate</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Bus Schedule</a></li>
            <li><a href="#">Terminals</a></li>
            <li><a href="#">Popular Routes</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Terminals</h4>
          <ul>
            <li><a href="#">Buendia Terminal</a></li>
            <li><a href="#">PITX Terminal</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Support</h4>
          <ul>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Cancellation Policy</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© <?php echo date('Y'); ?> DLTB CO. All rights reserved.</span>
      <span>Designed for seamless travel across Luzon.</span>
    </div>
  </div>
</footer>
<button id="back-top" aria-label="Back to top" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="visible">
  <svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"></polyline></svg>
</button>

<?php wp_footer(); ?>
</body>
</html>