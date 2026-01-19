document.addEventListener('DOMContentLoaded', function () {

    // ===== NAVBAR SCROLL (AMAN) =====
    const navbar = document.querySelector('.navbar');

    if (navbar) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow', 'py-2');
                navbar.classList.remove('py-3');
            } else {
                navbar.classList.remove('shadow', 'py-2');
                navbar.classList.add('py-3');
            }
        });
    }

    // ===== SMOOTH SCROLL (AMAN) =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#' || !document.querySelector(targetId)) return;

            e.preventDefault();

            const navbarHeight = navbar ? navbar.offsetHeight : 0;
            const targetPosition =
                document.querySelector(targetId).getBoundingClientRect().top +
                window.pageYOffset -
                navbarHeight;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });
    });

    // ===== SCROLL REVEAL (AMAN) =====
    function revealOnScroll() {
        document.querySelectorAll('.reveal').forEach(el => {
            if (el.getBoundingClientRect().top < window.innerHeight - 150) {
                el.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll();

    // ===== CONTACT FORM (TIDAK AKAN JALAN DI LOGIN) =====
    const contactForm = document.querySelector('#contact form');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Form terkirim');
        });
    }
});

function confirmLogout() {
    return confirm("Apakah Anda yakin ingin keluar?");
}
