<?php

// Search ferry destinations
// Helper to render the dropdown markup
if ( ! function_exists( 'render_custom_dropdown' ) ) {
  function render_custom_dropdown( string $id, string $label_text, string $name, array $data) { 
    ob_start(); ?>
    <div class="custom-select form-control" tabindex="0">
        <span class="selected-text" id="<?php echo "selected-".$id; ?>"><?php echo $label_text; ?></span>
        <input type="hidden" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $label_text; ?>">
        <ul class="options">
            <?php foreach ($data as $slug => $name_val): ?>
                <li data-value="<?php echo htmlspecialchars($slug); ?>">
                    <?php echo htmlspecialchars($name_val); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <?php return ob_get_clean();
  } 
} 

// 2. The Shortcode Definition
add_shortcode('cebu_ferry_booking', function() {

    $destinations = [
    'cebu'     => 'Cebu',
    'bohol'     => 'Bohol',
    'siquijor'  => 'Siquijor',
    'dumaguete' => 'Dumaguete',
    'manila'    => 'Manila',
    'ormoc'     => 'Ormoc',
    'siargao'    => 'Siargao',   
    'surigao'   => 'Surigao', 
    'dipolog'    => 'Dipolog', 
    'cagayan-de-oro'    => 'Cagayan De Oro',
    'tagbilaran'    => 'Tagbilaran',
    'tubigon'    => 'Tubigon',
    'getafe-bohol'    => 'Getafe',   
    'larena'    => 'Larena',
    'oslob'    => 'Oslob',
    'moalboal'    => 'Moalboal',
    'bogo'    => 'Bogo',
    'camotes-pier'    => 'Camotes',
    'batangas'    => 'Batangas',
    'misamis-oriental'    => 'Misamis',
    'dapitan'    => 'Dapitan',
    'masbate'    => 'Masbate',
    'palompon-port'    => 'Palompon',
    'maasin-port'    => 'Maasin',
    'iligan'    => 'Iligan',
    'ozamis'    => 'Ozamis',
    'nasipit-seaport'    => 'Nasipt',
    'calbayog'    => 'Calbayog',
    'hilongos'    => 'Hilongos',
    'baybay'    => 'Baybay'
    ]; 

    ob_start(); ?>

    <section id="booking" class="booking-section">
        <div class="booking-inner scs">
            <div class="booking-header">
            <p class="section-eyebrow adjust-center">Book Ferry Online</p>
            <h2 class="section-title section-title-light">Find Cebu Ferry Schedule</h2>
            <p class="section-desc" style="margin-top:0.5rem; color: rgba(255,255,255,0.6)">Select your route, date and passengers to check availability and pricing.</p>
            </div>

            <div class="booking-form">
            <div class="booking-tabs">
                <button class="booking-tab active" role="tab" aria-selected="true" data-mode="oneway">One Way</button>
                <button class="booking-tab" role="tab" aria-selected="false" data-mode="return">Return</button>
            </div>

            <div class="form-grid">
                <!-- Origin -->
                <div class="form-group">
                <span class="form-label">From</span>
                <?php echo render_custom_dropdown('booking-origin', 'Cebu', 'origin', $destinations); ?>
                </div>
                <!-- Destination -->
                <div class="form-group">
                <span class="form-label">To</span>
                <?php echo render_custom_dropdown('booking-destination', 'Bohol', 'destination', $destinations); ?>
                </div>
                <!-- Swap button spanning both -->
                <div style="grid-column:1/3; display:flex; justify-content:center; margin:-0.6rem 0;">
                <button class="booking-swap" type="button" style="background:var(--coral);color:white;border:none;border-radius:50%;width:32px;height:32px;cursor:pointer;font-size:1rem;display:flex;align-items:center;justify-content:center;">⇄</button>
                </div>

                <!-- Date -->
                <div class="form-group">
                <label for="booking-dep-date" class="form-label">Departure Date</label>
                <input class="form-control" type="date" id="booking-dep-date" name="dep_date">
                </div>
                <!-- Return date (hidden for one-way) -->
                <div class="form-group booking-return-date" aria-disabled="true">
                <label for="booking-ret-date" class="form-label">Return Date</label>
                <input class="form-control" type="date" id="booking-ret-date" name="ret_date" disabled>
                </div>

                <!-- Passengers label -->
                <div class="form-divider">Passengers</div>

                <!-- Adults -->
                <div class="form-group full">
                <div class="passenger-row">
                    <div class="passenger-info">
                    Adults
                    <div class="passenger-sub">12 years &amp; above</div>
                    </div>
                    <div class="passenger-counter">
                    <button class="counter-btn" data-target="adults" data-delta="-1">−</button>
                    <span class="counter-val" id="adults-count">1</span>
                    <button class="counter-btn" data-target="adults" data-delta="1">+</button>
                    </div>
                </div>
                </div>
                <!-- Children -->
                <div class="form-group full">
                <div class="passenger-row">
                    <div class="passenger-info">
                    Children
                    <div class="passenger-sub">3–11 years</div>
                    </div>
                    <div class="passenger-counter">
                    <button class="counter-btn" data-target="children" data-delta="-1">−</button>
                    <span class="counter-val" id="children-count">0</span>
                    <button class="counter-btn" data-target="children" data-delta="1">+</button>
                    </div>
                </div>
                </div>

                <!-- Search -->
                <button class="search-btn" id="ferry-search-btn" type="button">Search Available Ferries</button>
            </div>

            </div>
        </div>
    </section>

    <?php
    return ob_get_clean();
});
