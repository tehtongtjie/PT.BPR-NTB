document.addEventListener("DOMContentLoaded", function () {
    const dropdowns = document.querySelectorAll(".sb-dropdown");

    dropdowns.forEach((dropdown) => {
        const header = dropdown.querySelector(".sb-dropdown-header");

        header.addEventListener("click", () => {
            const isActive = dropdown.classList.contains("active");

            // Tutup semua dropdown lain (Accordion mode)
            dropdowns.forEach((other) => {
                other.classList.remove("active");
            });

            // Jika sebelumnya tidak aktif, maka buka
            if (!isActive) {
                dropdown.classList.add("active");
            }
        });
    });
});
