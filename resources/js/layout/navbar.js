document.addEventListener("DOMContentLoaded", function () {
    const subMenuToggles = document.querySelectorAll(
        ".dropdown-submenu > a"
    );

    subMenuToggles.forEach(function (el) {
        el.addEventListener("click", function (e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                e.stopPropagation();

                const nextMenu = this.nextElementSibling;
                if (nextMenu) {
                    const allOpenSubmenus = this.closest(
                        ".dropdown-menu"
                    ).querySelectorAll(".dropdown-menu.show");
                    allOpenSubmenus.forEach((m) => {
                        if (m !== nextMenu) m.classList.remove("show");
                    });

                    nextMenu.classList.toggle("show");
                }
            }
        });
    });
});
