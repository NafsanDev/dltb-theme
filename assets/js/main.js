// ── Navbar scroll behaviour ─────────────────
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
navbar.classList.toggle('scrolled', window.scrollY > 30);
}, { passive: true });

// ── Mobile hamburger toggle ─────────────────
const hamburger   = document.getElementById('hamburger');
const mobileMenu  = document.getElementById('mobile-menu');

hamburger.addEventListener('click', () => {
const isOpen = mobileMenu.classList.toggle('open');
hamburger.classList.toggle('open', isOpen);
hamburger.setAttribute('aria-expanded', String(isOpen));
document.body.style.overflow = isOpen ? 'hidden' : '';
});

// Close mobile menu on nav-link click
mobileMenu.querySelectorAll('a').forEach(link => {
link.addEventListener('click', () => {
    mobileMenu.classList.remove('open');
    hamburger.classList.remove('open');
    hamburger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
});
});

// search widget
( function () {
    'use strict';

    /*  Helpers */

    /**
     * Shorthand querySelectorAll with iteration.
     * @param {string} selector
     * @param {Element} [root=document]
     * @returns {Element[]}
     */
    function qsa( selector, root ) {
        return Array.from( ( root || document ).querySelectorAll( selector ) );
    }

    /**
     * Shorthand querySelector.
     * @param {string} selector
     * @param {Element} [root=document]
     * @returns {Element|null}
     */
    function qs( selector, root ) {
        return ( root || document ).querySelector( selector );
    }

     /*  Module: subMenuItems */

    function subMenuItems() {
        const parents = qsa('.menu-item-has-children');
        parents.forEach(parent => {
            const toggleBtn = parent.querySelector('button');
            
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const parentLi = this.parentElement;
                const isExpanded = parentLi.classList.contains('toggled-on');
                
                // Close other menus at the same level
                parentLi.parentElement.querySelectorAll('.toggled-on').forEach(el => {
                    if (el !== parentLi) el.classList.remove('toggled-on');
                });

                // Toggle current menu
                parentLi.classList.toggle('toggled-on');
                this.setAttribute('aria-expanded', !isExpanded);
            });
        });
    }
    
    /*  Module: BookingTabs */

    function initBookingTabs() {
        const tabs = qsa( '.booking-tab' );
        const returnField = qs( '.booking-return-date' );
        const returnInput = qs( '#booking-ret-date' );

        tabs.forEach( function ( tab ) {
            tab.addEventListener( 'click', function () {
                const mode = this.dataset.mode;

                tabs.forEach( function ( t ) {
                    t.classList.remove( 'active' );
                    t.setAttribute( 'aria-selected', 'false' );
                } );
                this.classList.add( 'active' );
                this.setAttribute( 'aria-selected', 'true' );

                if ( returnField ) {
                    const isReturn = mode === 'return';
                    returnField.setAttribute( 'aria-disabled', String( ! isReturn ) );
                    if ( returnInput ) returnInput.disabled = ! isReturn;
                }
            } );
        } );
    }

    /*  Select Origin n Destination */

    function initDestinationSelect() {
        const selectionArea = qsa( '.custom-select' );
        selectionArea.forEach(dropdown => {
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');
            const label = dropdown.querySelector('.selected-text');
            const list = dropdown.querySelector('.options');

            list.addEventListener('click', (e) => {
                if (e.target.tagName === 'LI') {
                    const val = e.target.getAttribute('data-value');
                    const txt = e.target.textContent;

                    hiddenInput.value = val; // Set the value for POST request
                    label.textContent = txt; // Update the visible text
                    dropdown.blur();         // Close the dropdown
                }
            });
        });
    }


    /*  Module: PassengerCounter  */

    function initPassengerCounters() {
        const counts = { adults: 1, children: 0 };
        const min    = { adults: 1, children: 0 };

        qsa( '.counter-btn' ).forEach( function ( btn ) {
            btn.addEventListener( 'click', function () {
                const target = this.dataset.target;
                const delta  = parseInt( this.dataset.delta, 10 );
                if ( ! target || isNaN( delta ) ) return;

                counts[ target ] = Math.max(
                    min[ target ] || 0,
                    ( counts[ target ] || 0 ) + delta
                );

                const output = qs( '#' + target + '-count' );
                if ( output ) output.textContent = counts[ target ];
            } );
        } );

        // Expose for FerrySearch.
        return counts;
    }

    /*  Module: RouteSwap */

    function initRouteSwap() {
        const btn  = qs( '.booking-swap' );
        const orig = qs( '#booking-origin' );
        const dest = qs( '#booking-destination' );
        const origSelected = qs( '#selected-booking-origin' );
        const destSelected = qs( '#selected-booking-destination' );
        if ( ! btn || ! orig || ! dest ) return;

        btn.addEventListener( 'click', function () {
            const tmpSelected = origSelected.textContent;
            origSelected.textContent = destSelected.textContent;
            destSelected.textContent =  tmpSelected;

            const tmp  = orig.value;
            orig.value = dest.value;
            dest.value = tmp;
        } );
    }

    /*  Module: DateDefaults  */

    function initDateDefaults() {
        const today     = new Date().toISOString().split( 'T' )[ 0 ];

        const depInput  = qs( '#booking-dep-date' );
        const retInput  = qs( '#booking-ret-date' );
        const depDate = new Date();
        depDate.setDate(depDate.getDate() + 3);
        const retDate = new Date();
        retDate.setDate(retDate.getDate() + 4);

        if ( depInput ) {
            depInput.value = new Date(depDate).toISOString().substr(0, 10);
        }
        if ( retInput ) {
            retInput.value = new Date(retDate).toISOString().substr(0, 10);
        }
    }

    
    /*  Bootstrap */

    document.addEventListener( 'DOMContentLoaded', function () {
        subMenuItems()
        initBookingTabs();
        initDestinationSelect();
        initPassengerCounters();
        initRouteSwap();
        initDateDefaults();
    } );

} () );

/*  Module: Search  */

jQuery( document ).ready(function($) {

    $('select').on('change', function() {
        var selectedValue = $(this).val();
        if (selectedValue && selectedValue.trim() !== "") {
            $(this).removeClass('is-invalid');
        } else {
            $(this).addClass('is-invalid');
        }
    });

    function validateField(field) {
        const value = $(field).val().trim();
        let isValid = true;

        if(value === '') {
            $(field).addClass('is-invalid');
            isValid = false;
        }else {
            $(field).removeClass('is-invalid');
        }
        return isValid;
    }

    $('#ferry-search-btn').on('click', function(e) {
        e.preventDefault();

        let baseUrl   = "https://book.phbus.com/en/travel/",
        isSelected = $( '.booking-tab.active' ).attr('data-mode'),
        origin = $( '#booking-origin' ).val(),
        destination = $( '#booking-destination' ).val(),
        departureDate = $( '#booking-dep-date' ).val(),
        returnDate = $( '#booking-ret-date' ).val(),
        adultNumber = +$( '#adults-count' ).text(),
        childNumber = +$( '#children-count' ).text(),
        totalPassenger = adultNumber + childNumber,
        validBooking = true;

        if ( 
            ! validateField('#booking-origin') || 
            ! validateField('#booking-destination') || 
            ! validateField('#booking-dep-date') || 
            isNaN(totalPassenger)
        ) {
            validBooking = false;
        }

        if ( isSelected === 'return' && ! validateField('#booking-ret-date') ){
            validBooking = false;
        }

        origin = origin.replace(/\s/g , "-").toLowerCase();
        destination = destination.replace(/\s/g , "-").toLowerCase();

        if (origin === destination){
            $('#booking-origin').addClass("is-invalid");
            $('#booking-destination').addClass("is-invalid");
            validBooking = false;
        }

        if ( ! validBooking ) return;

        if(isSelected === 'oneway'){
            baseUrl += origin+"/"+destination+"?date="+departureDate+"&people="+totalPassenger+"&adults="+adultNumber+"&children="+childNumber+"&direction=forward&z=1563876&sub_id=siquijorferry.ph";
            window.open(baseUrl, '_blank');
        }else if(isSelected === 'return'){
            baseUrl += origin+"/"+destination+"?date="+departureDate+"&date2="+returnDate+"&people="+totalPassenger+"&adults="+adultNumber+"&children="+childNumber+"&direction=forward&z=1563876&sub_id=siquijorferry.ph";
            window.open(baseUrl, '_blank');
        }else{
            e.preventDefault();
        }
    });
});

// dlt script

// Hamburger menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            mobileMenu.classList.toggle('open');
            document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
        });

        // Close mobile menu when clicking any link inside it
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('open');
                mobileMenu.classList.remove('open');
                document.body.style.overflow = '';
            });
        });
    }

    // FAQ accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const q = item.querySelector('.faq-q');
        if (q) {
            q.addEventListener('click', () => {
                item.classList.toggle('open');
            });
        }
    });

    // Back to top button visibility
    const backTop = document.getElementById('back-top');
    const footer = document.getElementById('site-footer');
    const navbar     = document.getElementById('navbar');

    function updateBackToTop() {
        if (!backTop || !footer) return;
        const scrollY = window.scrollY;
        const viewportH = window.innerHeight;
        const footerTop = footer.offsetTop;

        navbar.classList.toggle('scrolled', scrollY > 60);

        if (scrollY > viewportH && scrollY + viewportH < footerTop - 100) {
            backTop.classList.add('visible');
        } else {
            backTop.classList.remove('visible');
        }
    }

    window.addEventListener('scroll', updateBackToTop);
    window.addEventListener('resize', updateBackToTop);
    updateBackToTop();

    // Back to top click
    if (backTop) {
        backTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Optional: sticky navbar background already handled by CSS
});

// SELECT POPULAR ORIGINS AND DESTINATIONS
jQuery( document ).ready(function($) {
    const hsfCities = [
        'Manila', 
        'Bontoc', 
        'Bulan', 
        'Daet', 
        'Donsol', 
        'Goa', 
        'Gubat', 
        'Guinobatan', 
        'Guiuan', 
        'Iriga', 
        'Lagonoy', 
        'Legazpi', 
        'Matnog', 
        'Maasin', 
        'Naga', 
        'Ormoc', 
        'Palompon', 
        'Polangui', 
        'Rawis', 
        'San Jose', 
        'San Ricardo', 
        'Silago', 
        'Sorsogon', 
        'Tabaco', 
        'Tacloban'
    ];

    let activeInput = null;
    const $heroInputs = $('.search-form input[type="text"]');
    const $heroResults = $('.city-list');

    // Handle input focus/click
    $heroInputs.on('focus click', function() {
        $(this).closest('.search-field').removeClass('is-invalid');
        $(this).val('');
        activeInput = $(this);
        const targetResults = $(`#${activeInput.data('target')}`);
        heroShowAllCities(targetResults);
                
        // Hide other results
        $heroResults.not(targetResults).hide();
    });

    // Handle input typing
    $heroInputs.on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        const targetResults = $(`#${activeInput.data('target')}`);
        
        if (searchTerm.length === 0) {
            heroShowAllCities(targetResults);
        } else {
            const matches = hsfCities.filter(city => 
                city.toLowerCase().startsWith(searchTerm)
            );
            heroUpdateResults(matches, targetResults);
        }
    });

    // Show all cities initially
    function heroShowAllCities(target) {
        heroUpdateResults(hsfCities, target);
        target.show();
    }

    // Update results display
    function heroUpdateResults(matches, target) {
        target.empty();
        
        matches.forEach(city => {
            target.append(
                $('<li>')
                    .text(city)
                    .click(() => {
                        activeInput.val(city);
                        target.hide();
                    })
            );
        });
    }

    // Hide results when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('input, .city-list').length) {
            $heroResults.hide();
        }
    });
});

// Form Submit
jQuery( document ).ready(function($) {
    // Show date, Format
    const dep = new Date();
    dep.setDate(dep.getDate() + 6);
    $("#hsf_dates").val(new Date(dep).toISOString().substr(0, 10));

    // Swipe Button
    $('#hsf_swap').click(function(){
        let msfFrom = $('#hsf_origin').val(),
        msfTo = $('#hsf_destination').val();
        $('#hsf_origin').val(msfTo);
        $('#hsf_destination').val(msfFrom);
    });

    function heroValidateField(field) {
        const value = $(field).val().trim();
        let parentFolder = $(field).closest('.search-field');
        let isValid = true;

        if(value === '') {
            $(parentFolder).addClass('is-invalid');
            isValid = false;
        }else if(value.length < 4) {
            $(parentFolder).addClass('is-invalid');
            isValid = false;
        }else {
            $(parentFolder).removeClass('is-invalid');
        }
        return isValid;
    }

    // Booking submit
     $('#hsf_submit').on('click', function(e) {
        e.preventDefault();
        let formValid = true,
        hsfOrigin = $('#hsf_origin').val(),
        hsfDestination = $('#hsf_destination').val(),
        hsfDate = $('#hsf_dates').val(),
        hsfURL = "https://book.phbus.com/en/travel/";

        // Validate origin
        if(!heroValidateField('#hsf_origin')) {
            formValid = false;
        }

        // Validate destination
        if(!heroValidateField('#hsf_destination')) {
            formValid = false;
        }

        // Same input
        if(hsfOrigin === hsfDestination){
            $('input[type="text"]').closest('.search-field').addClass('is-invalid');
            formValid = false;
        }

        if(formValid) {
            hsfOrigin = hsfOrigin.replace(/\s/g , "-").toLowerCase();
            hsfDestination = hsfDestination.replace(/\s/g , "-").toLowerCase();
            hsfURL += hsfOrigin+"/"+hsfDestination+"?date="+hsfDate+"&people=2&z=1563876&sub_id=dltbonlinebooking.ph";
            window.open(hsfURL, '_blank');
        }else{
            e.preventDefault();
        }
    });
})