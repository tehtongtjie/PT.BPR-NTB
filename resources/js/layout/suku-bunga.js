document.addEventListener("DOMContentLoaded", () => {
    const dropdowns = document.querySelectorAll(".sb-dropdown");

    dropdowns.forEach((dropdown) => {
        const header = dropdown.querySelector(".sb-dropdown-header");
        const content = dropdown.querySelector(".sb-dropdown-content");

        header.addEventListener("click", () => {
            const isActive = dropdown.classList.contains("active");

            // 1. Tutup semua dropdown lain (Opsional, agar hanya satu yang terbuka)
            dropdowns.forEach((otherDropdown) => {
                if (otherDropdown !== dropdown) {
                    otherDropdown.classList.remove("active");
                    otherDropdown.querySelector(
                        ".sb-dropdown-content",
                    ).style.maxHeight = null;
                }
            });

            // 2. Toggle class active pada yang diklik
            dropdown.classList.toggle("active");

            // 3. Atur maxHeight secara dinamis
            if (dropdown.classList.contains("active")) {
                content.style.maxHeight = content.scrollHeight + "px";
            } else {
                content.style.maxHeight = null;
            }
        });
    });

    // Reset tinggi jika layar di-resize (agar data tidak terpotong di mobile)
    window.addEventListener("resize", () => {
        const activeDropdown = document.querySelector(
            ".sb-dropdown.active .sb-dropdown-content",
        );
        if (activeDropdown) {
            activeDropdown.style.maxHeight = activeDropdown.scrollHeight + "px";
        }
    });
});
