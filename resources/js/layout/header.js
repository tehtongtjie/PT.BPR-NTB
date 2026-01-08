document.addEventListener("DOMContentLoaded", function () {
    const header = document.getElementById("siteHeader");
    const spacer = document.getElementById("headerSpacer");

    function setHeaderSpacerHeight() {
        if (!header || !spacer) return;

        const headerHeight = header.offsetHeight;
        spacer.style.height = headerHeight + "px";
    }

    // Set saat load
    setHeaderSpacerHeight();

    // Update saat resize (responsive)
    window.addEventListener("resize", setHeaderSpacerHeight);
});
