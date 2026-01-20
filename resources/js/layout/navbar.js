// ================= NAVBAR SCROLL BEHAVIOR =================
class NavbarScroll {
    constructor() {
        this.header = document.querySelector(".header-fixed");
        this.scrollThreshold = 100;
        this.lastScrollY = 0;
        this.scrolling = false;

        if (this.header) {
            this.init();
        }
    }

    init() {
        // Initial check
        this.handleScroll();

        // Throttled scroll event
        window.addEventListener("scroll", () => {
            if (!this.scrolling) {
                this.scrolling = true;
                requestAnimationFrame(() => {
                    this.handleScroll();
                    this.scrolling = false;
                });
            }
        });
    }

    handleScroll() {
        const scrollY = window.scrollY;
        const isHomePage = document.body.classList.contains("home-page");

        // Add shadow on scroll
        if (scrollY > this.scrollThreshold) {
            this.header.classList.add("scrolled");
            this.header.style.boxShadow = "var(--shadow-lg)";
        } else {
            this.header.classList.remove("scrolled");
            this.header.style.boxShadow = "none";
        }

        // Smooth scroll behavior for non-home pages
        if (!isHomePage && scrollY > 50) {
            const scrollDirection = scrollY > this.lastScrollY ? "down" : "up";

            if (scrollDirection === "down") {
                this.header.style.transform = "translateY(-100%)";
            } else {
                this.header.style.transform = "translateY(0)";
            }
        }

        this.lastScrollY = scrollY;
    }
}

// ================= MOBILE SIDEBAR MANAGER =================
class MobileSidebar {
    constructor() {
        this.toggler = document.querySelector(".navbar-toggler");
        this.sidebar = document.querySelector(".navbar-collapse");
        this.overlay = document.querySelector(".sidebar-overlay");
        this.closeBtn = null;

        this.init();
    }

    init() {
        if (!this.toggler || !this.sidebar) return;

        // Create overlay if not exists
        this.createOverlay();

        // Create close button inside sidebar
        this.createCloseButton();

        // Setup event listeners
        this.setupEvents();

        // Handle dropdowns
        this.setupDropdowns();

        // Handle resize
        this.handleResize();
    }

    createOverlay() {
        if (!this.overlay) {
            this.overlay = document.createElement("div");
            this.overlay.className = "sidebar-overlay";
            document.body.appendChild(this.overlay);
        }
    }

    createCloseButton() {
        // Add close button at top of sidebar
        const closeBtn = document.createElement("button");
        closeBtn.className = "sidebar-close";
        closeBtn.innerHTML =
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>';

        const sidebarHeader = document.createElement("div");
        sidebarHeader.className = "sidebar-header";
        sidebarHeader.appendChild(closeBtn);

        this.sidebar.insertBefore(sidebarHeader, this.sidebar.firstChild);
        this.closeBtn = closeBtn;
    }

    setupEvents() {
        // Toggle sidebar
        this.toggler.addEventListener("click", (e) => {
            e.stopPropagation();
            this.toggle();
        });

        // Close with overlay
        this.overlay.addEventListener("click", () => this.close());

        // Close with close button
        this.closeBtn.addEventListener("click", () => this.close());

        // Close with Escape key
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && this.isOpen) {
                this.close();
            }
        });

        // Prevent body scroll when sidebar is open
        this.sidebar.addEventListener(
            "touchmove",
            (e) => {
                if (this.isOpen) {
                    e.preventDefault();
                }
            },
            { passive: false },
        );
    }

    setupDropdowns() {
        const dropdownToggles =
            this.sidebar.querySelectorAll(".dropdown-toggle");

        dropdownToggles.forEach((toggle) => {
            // Remove Bootstrap's default behavior
            toggle.setAttribute("data-bs-toggle", "");

            toggle.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();

                const dropdown = toggle.closest(".dropdown");
                const menu = dropdown.querySelector(".dropdown-menu");
                const isExpanded =
                    toggle.getAttribute("aria-expanded") === "true";

                // Close other dropdowns
                this.closeOtherDropdowns(dropdown);

                // Toggle current dropdown
                if (isExpanded) {
                    this.closeDropdown(toggle, menu);
                } else {
                    this.openDropdown(toggle, menu);
                }
            });
        });

        // Close dropdowns when clicking on menu item (for navigation)
        this.sidebar.addEventListener("click", (e) => {
            const dropdownItem = e.target.closest(".dropdown-item");
            if (
                dropdownItem &&
                !dropdownItem.classList.contains("dropdown-toggle")
            ) {
                this.close();
            }
        });
    }

    handleResize() {
        let resizeTimer;
        window.addEventListener("resize", () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth > 991 && this.isOpen) {
                    this.close();
                }
            }, 250);
        });
    }

    toggle() {
        if (this.isOpen) {
            this.close();
        } else {
            this.open();
        }
    }

    open() {
        this.sidebar.classList.add("show");
        this.overlay.classList.add("active");
        this.toggler.classList.add("collapsed");
        this.isOpen = true;

        // Prevent body scroll
        document.body.style.overflow = "hidden";
        document.body.style.paddingRight = this.getScrollbarWidth() + "px";
        this.header.style.paddingRight = this.getScrollbarWidth() + "px";
    }

    close() {
        this.sidebar.classList.remove("show");
        this.overlay.classList.remove("active");
        this.toggler.classList.remove("collapsed");
        this.isOpen = false;

        // Restore body scroll
        document.body.style.overflow = "";
        document.body.style.paddingRight = "";
        this.header.style.paddingRight = "";

        // Close all dropdowns
        this.closeAllDropdowns();
    }

    openDropdown(toggle, menu) {
        toggle.setAttribute("aria-expanded", "true");
        menu.classList.add("show-custom");

        // Animate height
        menu.style.maxHeight = "0";
        setTimeout(() => {
            const height = menu.scrollHeight;
            menu.style.maxHeight = height + "px";
            menu.style.transition = "max-height 0.3s ease";
        }, 10);
    }

    closeDropdown(toggle, menu) {
        toggle.setAttribute("aria-expanded", "false");
        menu.style.maxHeight = "0";

        setTimeout(() => {
            menu.classList.remove("show-custom");
            menu.style.maxHeight = "";
            menu.style.transition = "";
        }, 300);
    }

    closeOtherDropdowns(exceptDropdown) {
        const allDropdowns = this.sidebar.querySelectorAll(".dropdown");

        allDropdowns.forEach((dropdown) => {
            if (dropdown !== exceptDropdown) {
                const toggle = dropdown.querySelector(".dropdown-toggle");
                const menu = dropdown.querySelector(".dropdown-menu");

                if (
                    toggle &&
                    menu &&
                    toggle.getAttribute("aria-expanded") === "true"
                ) {
                    this.closeDropdown(toggle, menu);
                }
            }
        });
    }

    closeAllDropdowns() {
        const dropdownToggles = this.sidebar.querySelectorAll(
            '.dropdown-toggle[aria-expanded="true"]',
        );
        const dropdownMenus = this.sidebar.querySelectorAll(
            ".dropdown-menu.show-custom",
        );

        dropdownToggles.forEach((toggle) =>
            toggle.setAttribute("aria-expanded", "false"),
        );
        dropdownMenus.forEach((menu) => {
            menu.classList.remove("show-custom");
            menu.style.maxHeight = "";
        });
    }

    getScrollbarWidth() {
        // Create temporary element to measure scrollbar width
        const scrollDiv = document.createElement("div");
        scrollDiv.style.width = "100px";
        scrollDiv.style.height = "100px";
        scrollDiv.style.overflow = "scroll";
        scrollDiv.style.position = "absolute";
        scrollDiv.style.top = "-9999px";
        document.body.appendChild(scrollDiv);

        const scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
        document.body.removeChild(scrollDiv);

        return scrollbarWidth;
    }
}

// ================= DESKTOP DROPDOWN ENHANCEMENT =================
class DesktopDropdown {
    constructor() {
        this.dropdowns = document.querySelectorAll(".nav-item.dropdown");

        if (window.innerWidth >= 992) {
            this.init();
        }
    }

    init() {
        this.dropdowns.forEach((dropdown) => {
            const toggle = dropdown.querySelector(".dropdown-toggle");
            const menu = dropdown.querySelector(".dropdown-menu");

            if (!toggle || !menu) return;

            // Mouse enter
            dropdown.addEventListener("mouseenter", () => {
                this.openDropdown(dropdown, menu);
            });

            // Mouse leave with delay
            dropdown.addEventListener("mouseleave", (e) => {
                // Check if mouse is moving to dropdown menu
                const relatedTarget = e.relatedTarget;
                if (
                    relatedTarget &&
                    !dropdown.contains(relatedTarget) &&
                    !menu.contains(relatedTarget)
                ) {
                    this.closeDropdownWithDelay(dropdown, menu);
                }
            });

            // Also handle menu mouse leave
            menu.addEventListener("mouseleave", (e) => {
                const relatedTarget = e.relatedTarget;
                if (
                    relatedTarget &&
                    !dropdown.contains(relatedTarget) &&
                    !menu.contains(relatedTarget)
                ) {
                    this.closeDropdownWithDelay(dropdown, menu);
                }
            });
        });
    }

    openDropdown(dropdown, menu) {
        // Clear any existing close timeout
        if (dropdown.closeTimeout) {
            clearTimeout(dropdown.closeTimeout);
            dropdown.closeTimeout = null;
        }

        menu.style.opacity = "1";
        menu.style.visibility = "visible";
        menu.style.pointerEvents = "auto";
        menu.style.transform = "translateY(0)";

        // For submenus
        if (dropdown.classList.contains("dropdown-submenu")) {
            menu.style.transform = "translateX(0)";
        }
    }

    closeDropdownWithDelay(dropdown, menu) {
        dropdown.closeTimeout = setTimeout(() => {
            this.closeDropdown(dropdown, menu);
        }, 150); // Small delay to prevent flickering
    }

    closeDropdown(dropdown, menu) {
        menu.style.opacity = "0";
        menu.style.visibility = "hidden";
        menu.style.pointerEvents = "none";
        menu.style.transform = "translateY(15px)";

        // For submenus
        if (dropdown.classList.contains("dropdown-submenu")) {
            menu.style.transform = "translateX(15px)";
        }
    }
}

// ================= SMOOTH SCROLL FOR ANCHOR LINKS =================
class SmoothScrollNav {
    constructor() {
        this.navLinks = document.querySelectorAll('.nav-link[href^="#"]');
        this.dropdownLinks = document.querySelectorAll(
            '.dropdown-item[href^="#"]',
        );

        this.init();
    }

    init() {
        const allLinks = [...this.navLinks, ...this.dropdownLinks];

        allLinks.forEach((link) => {
            link.addEventListener("click", (e) => {
                const href = link.getAttribute("href");

                // Skip empty or non-anchor links
                if (href === "#" || href === "") return;

                const target = document.querySelector(href);
                if (!target) return;

                e.preventDefault();
                this.scrollToTarget(target);

                // Close mobile sidebar if open
                if (window.innerWidth <= 991) {
                    const sidebar = document.querySelector(
                        ".navbar-collapse.show",
                    );
                    if (sidebar) {
                        sidebar.classList.remove("show");
                        document
                            .querySelector(".sidebar-overlay")
                            ?.classList.remove("active");
                        document.body.style.overflow = "";
                    }
                }
            });
        });
    }

    scrollToTarget(target) {
        const headerHeight =
            document.querySelector(".header-fixed")?.offsetHeight || 0;
        const targetPosition =
            target.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = targetPosition - headerHeight - 20;

        window.scrollTo({
            top: offsetPosition,
            behavior: "smooth",
        });
    }
}

// ================= CURRENT PAGE HIGHLIGHT =================
class CurrentPageHighlight {
    constructor() {
        this.init();
    }

    init() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll(".nav-link");
        const dropdownItems = document.querySelectorAll(".dropdown-item");

        // Highlight nav links
        navLinks.forEach((link) => {
            const linkPath = link.getAttribute("href");
            if (this.isCurrentPage(linkPath, currentPath)) {
                link.classList.add("active");

                // Also highlight parent dropdown if exists
                const parentDropdown = link.closest(".dropdown");
                if (parentDropdown) {
                    const parentToggle =
                        parentDropdown.querySelector(".dropdown-toggle");
                    if (parentToggle) parentToggle.classList.add("active");
                }
            }
        });

        // Highlight dropdown items
        dropdownItems.forEach((item) => {
            const itemPath = item.getAttribute("href");
            if (this.isCurrentPage(itemPath, currentPath)) {
                item.classList.add("active");

                // Also open parent dropdown
                const parentDropdown = item.closest(".dropdown-menu");
                if (parentDropdown) {
                    parentDropdown.classList.add("show-custom");

                    // Find and expand parent toggle
                    const parentToggle = parentDropdown.previousElementSibling;
                    if (
                        parentToggle &&
                        parentToggle.classList.contains("dropdown-toggle")
                    ) {
                        parentToggle.setAttribute("aria-expanded", "true");
                    }
                }
            }
        });
    }

    isCurrentPage(linkPath, currentPath) {
        if (!linkPath) return false;

        // Handle home page
        if (linkPath === "/" && currentPath === "/") return true;

        // Handle other pages
        return currentPath.includes(linkPath) && linkPath !== "/";
    }
}

// ================= INITIALIZE EVERYTHING =================
document.addEventListener("DOMContentLoaded", () => {
    // Initialize components
    const navbarScroll = new NavbarScroll();
    const mobileSidebar = new MobileSidebar();
    const desktopDropdown = new DesktopDropdown();
    const smoothScroll = new SmoothScrollNav();
    const pageHighlight = new CurrentPageHighlight();

    // Handle window resize for desktop dropdowns
    window.addEventListener("resize", () => {
        if (window.innerWidth >= 992) {
            new DesktopDropdown();
        }
    });

    // Expose for debugging if needed
    window.navbarComponents = {
        navbarScroll,
        mobileSidebar,
        desktopDropdown,
        smoothScroll,
        pageHighlight,
    };
});

// ================= FALLBACK FOR OLDER BROWSERS =================
if (!("scrollBehavior" in document.documentElement.style)) {
    // Polyfill for smooth scroll
    const smoothScrollPolyfill = () => {
        const originalScrollTo = window.scrollTo;
        window.scrollTo = function (options) {
            if (options && options.behavior === "smooth") {
                const start = window.pageYOffset;
                const end =
                    typeof options.top === "number" ? options.top : start;
                const duration = 500;
                const startTime = performance.now();

                const animateScroll = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);

                    window.scrollTo(
                        0,
                        start + (end - start) * this.easeInOutCubic(progress),
                    );

                    if (progress < 1) {
                        requestAnimationFrame(animateScroll);
                    }
                };

                requestAnimationFrame(animateScroll);
            } else {
                originalScrollTo.apply(this, arguments);
            }
        };

        // Easing function
        window.easeInOutCubic = function (t) {
            return t < 0.5
                ? 4 * t * t * t
                : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1;
        };
    };

    smoothScrollPolyfill();
}
