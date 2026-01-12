/**
 * Toggle Simpanan Berjangka Table Dropdown
 * Dibuat global agar bisa dipanggil dari HTML (onclick)
 */
function toggleSB(id) {
    const allWrappers = document.querySelectorAll(".sb-table-wrapper");

    allWrappers.forEach((wrapper) => {
        if (wrapper.id !== id) {
            wrapper.classList.remove("active");
        }
    });

    const target = document.getElementById(id);
    if (target) {
        target.classList.toggle("active");
    }
}

// expose ke global scope
window.toggleSB = toggleSB;
