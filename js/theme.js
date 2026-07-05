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
    const faqItems = document.querySelectorAll('.schema-faq-section');
    faqItems.forEach(item => {
        const q = item.querySelector('.schema-faq-question');
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

document.querySelectorAll(".bus-search").forEach(initWidget);

function initWidget(widget) {

    const origin = widget.querySelector(".origin");
    const destination = widget.querySelector(".destination");
    const date = widget.querySelector(".date");
    const passengers = widget.querySelector(".passengers");

    const swap = widget.querySelector(".swap");
    const search = widget.querySelector(".search");

    const increase = widget.querySelector(".increase");
    const decrease = widget.querySelector(".decrease");

    createDropdown(origin);
    createDropdown(destination);

    // Swap
    swap.addEventListener("click", function () {
        const temp = origin.value;
        origin.value = destination.value;
        destination.value = temp;
    });

    // Increase passengers
    increase.addEventListener("click", function () {
        passengers.value = parseInt(passengers.value || 1) + 1;
    });

    // Decrease passengers
    decrease.addEventListener("click", function () {
        let value = parseInt(passengers.value || 1);

        if (value > 1) {
            passengers.value = value - 1;
        }
    });

    // Search
    search.addEventListener("click", function () {

        function cityToSlug(city) {
            return city
                .trim()
                .toLowerCase()
                .replace(/\s+/g, "-");
        }

        const from = cityToSlug(origin.value);
        const to = cityToSlug(destination.value);
        const travelDate = date.value;
        const people = passengers.value;

        // Reset previous errors
        origin.classList.remove("error");
        destination.classList.remove("error");
        date.classList.remove("error");

        // Validation
        if (!from) {
            origin.classList.add("error");
            origin.focus();
            return;
        }

        if (!to) {
            destination.classList.add("error");
            destination.focus();
            return;
        }

        if (from === to) {
            alert("Origin and destination cannot be the same.");
            destination.focus();
            return;
        }

        if (!travelDate) {
            date.classList.add("error");
            date.focus();
            return;
        }

        // Build URL
        const url =
            `https://book.phbus.com/en/travel/${encodeURIComponent(from)}/${encodeURIComponent(to)}` +
            `?date=${travelDate}&people=${people}&z=1563876&sub_id=dltbonlinebooking.ph`;

        // Redirect
        window.open(url, '_blank');

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

            widget.querySelectorAll(".city-list").forEach(dropdown => {
                dropdown.style.display = "none";
            });

            list.style.display = "block";

        });

    }

}

// Hide dropdowns when clicking outside
document.addEventListener("click", function (e) {

    // If the click is NOT on a city input or inside a dropdown
    if (!e.target.closest(".city") && !e.target.closest(".city-list")) {

        document.querySelectorAll(".city-list").forEach(list => {
            list.style.display = "none";
        });

    }

});