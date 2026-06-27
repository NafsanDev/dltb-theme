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

// Search Widgets
const cities = [
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

// Set future date
const dep = new Date();
dep.setDate(dep.getDate() + 6);
const dateString = new Date(dep).toISOString().slice(0, 10);

// Loop through all elements with the class "date" and set their value
document.querySelectorAll(".date").forEach(element => {
  element.value = dateString;
});

// Swap origin & destination
const bookingSwap = document.querySelector(".swap");
bookingSwap.addEventListener("click", function () {
    const bookingOrigin = document.querySelector(".origin");
    const bookingDestination = document.querySelector(".destination");
    const temp = bookingOrigin.value;
    bookingOrigin.value = bookingDestination.value;
    bookingDestination.value = temp; 

});
// Initialize every search widget
document.querySelectorAll(".bus-search").forEach(initWidget);

function initWidget(widget) {

    const origin = widget.querySelector(".origin");
    const destination = widget.querySelector(".destination");
    const search = widget.querySelector(".search");

    createDropdown(origin);
    createDropdown(destination); 

    // Search button
    search.addEventListener("click", function () {

        const data = {
            origin: origin.value,
            destination: destination.value,
            date: widget.querySelector(".date").value,
            passengers: widget.querySelector(".passengers").value
        };

        console.log("Searching:", data);

        // Your search function here...
    });

    function createDropdown(input) {

        const list = document.createElement("ul");
        list.className = "city-list";

        cities.forEach(city => {

            const li = document.createElement("li");
            li.textContent = city;

            li.addEventListener("click", function () {

                input.value = city;
                list.style.display = "none";

            });

            list.appendChild(li);

        });

        input.insertAdjacentElement("afterend", list);

        input.addEventListener("click", function () {

            // Hide dropdowns only inside this widget
            widget.querySelectorAll(".city-list").forEach(dropdown => {
                dropdown.style.display = "none";
            });

            list.style.display = "block";

        });

    }

}

// Hide all dropdowns when clicking outside any widget
document.addEventListener("click", function (e) {

    if (e.target.closest(".bus-search")) return;

    document.querySelectorAll(".city-list").forEach(list => {
        list.style.display = "none";
    });

});