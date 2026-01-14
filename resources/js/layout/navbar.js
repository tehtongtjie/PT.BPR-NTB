document.addEventListener("DOMContentLoaded", function () {
    const dropdownToggles = document.querySelectorAll(".dropdown-toggle");
    const submenuToggles = document.querySelectorAll(".dropdown-submenu > a");

    // --- LOGIKA UNTUK DROPDOWN UTAMA ---
    dropdownToggles.forEach((toggle) => {
        toggle.addEventListener("click", function (e) {
            // Cek jika lebar layar adalah HP/Tablet ( < 992px )
            if (window.innerWidth < 992) {
                e.preventDefault();
                e.stopPropagation();

                const menu = this.nextElementSibling;

                // Tutup dropdown lain yang sedang terbuka
                document
                    .querySelectorAll(".dropdown-menu.show")
                    .forEach((openMenu) => {
                        if (
                            openMenu !== menu &&
                            !this.closest(".dropdown-menu")
                        ) {
                            openMenu.classList.remove("show");
                        }
                    });

                menu.classList.toggle("show");
            }
            // Jika di Desktop ( >= 992px ), biarkan CSS Hover yang bekerja
            // Jangan pakai e.preventDefault() di sini agar link tetap bisa diklik jika perlu
        });
    });

    // --- LOGIKA UNTUK SUBMENU ---
    submenuToggles.forEach((sub) => {
        sub.addEventListener("click", function (e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                e.stopPropagation();
                this.nextElementSibling.classList.toggle("show");
            }
        });
    });

    // Tutup semua menu jika klik di luar navbar
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".bpr-navbar")) {
            document
                .querySelectorAll(".dropdown-menu")
                .forEach((m) => m.classList.remove("show"));
        }
    });
});
