// Jaringan Kantor Page JavaScript
class JaringanKantor {
    constructor() {
        this.map = null;
        this.markers = [];
        this.currentKantor = null;
        this.kantorData = [];
        this.searchInput = null;
        this.activeFilter = "all";
        this.initialized = false;
        this.mapInitialized = false;
    }

    // Initialize when document is ready
    init() {
        if (this.initialized) return;

        this.loadKantorData();
        this.initializeFilters();
        this.initializeSearch();
        this.initializeExport();
        this.setupEventListeners();
        this.initializeMapModal();
        this.initialized = true;

        console.log("Jaringan Kantor initialized successfully");
    }

    // Initialize map modal events
    initializeMapModal() {
        const mapModal = document.getElementById("mapModal");
        if (mapModal) {
            // Initialize map when modal is shown
            mapModal.addEventListener("show.bs.modal", () => {
                setTimeout(() => {
                    this.initializeMap();
                }, 100);
            });

            // Invalidate size when modal is shown
            mapModal.addEventListener("shown.bs.modal", () => {
                if (this.map) {
                    setTimeout(() => {
                        this.map.invalidateSize();
                        this.map.setView(
                            this.map.getCenter(),
                            this.map.getZoom(),
                        );
                    }, 300);
                }
            });

            // Clean up when modal is hidden
            mapModal.addEventListener("hidden.bs.modal", () => {
                this.clearMarkers();
                this.currentKantor = null;
            });
        }
    }

    // Load kantor data from table
    loadKantorData() {
        const rows = document.querySelectorAll(".kantor-row");
        this.kantorData = Array.from(rows).map((row, index) => {
            const type = row.dataset.type || "cabang";
            const lat = parseFloat(row.dataset.lat) || null;
            const lng = parseFloat(row.dataset.lng) || null;
            const teleponElement = row.querySelector("td:nth-child(5) a");
            const teleponText = teleponElement
                ? teleponElement.textContent.trim()
                : "";

            return {
                id: row.dataset.id || `kantor-${index + 1}`,
                type: type,
                nama:
                    row.querySelector("td:nth-child(3) .kantor-nama")
                        ?.textContent ||
                    row.querySelector("td:nth-child(3) .fw-bold")
                        ?.textContent ||
                    row.querySelector("td:nth-child(3)").textContent.trim(),
                kode:
                    row.querySelector("td:nth-child(3) .kantor-kode")
                        ?.textContent ||
                    row.querySelector("td:nth-child(3) .text-muted")
                        ?.textContent ||
                    "",
                alamat:
                    row.querySelector("td:nth-child(4) .kantor-alamat")
                        ?.textContent ||
                    row.querySelector("td:nth-child(4) .fw-medium")
                        ?.textContent ||
                    row.querySelector("td:nth-child(4)").textContent.trim(),
                kota:
                    row.querySelector("td:nth-child(4) .kantor-kota")
                        ?.textContent ||
                    row.querySelector("td:nth-child(4) .text-muted")
                        ?.textContent ||
                    "NTB",
                telepon: teleponText,
                jam:
                    row.querySelector("td:nth-child(5) .kantor-jam")
                        ?.textContent ||
                    row.querySelector("td:nth-child(5) small")?.textContent ||
                    "08:00 - 16:00",
                lat: lat,
                lng: lng,
                navigasi: row.querySelector("td:nth-child(6) a")?.href || null,
            };
        });

        console.log(`Loaded ${this.kantorData.length} kantor records`);
    }

    // Initialize filter functionality
    initializeFilters() {
        const filterButtons = document.querySelectorAll(".filter-btn");

        filterButtons.forEach((button) => {
            button.addEventListener("click", (e) => {
                e.preventDefault();

                // Remove active class from all buttons
                filterButtons.forEach((btn) => btn.classList.remove("active"));

                // Add active class to clicked button
                button.classList.add("active");

                // Get filter value
                this.activeFilter = button.dataset.filter;

                // Show loading
                this.showLoading(true);

                // Filter table rows
                this.filterTableRows();

                // Update statistics
                this.updateStatistics();

                // Hide loading after delay
                setTimeout(() => this.showLoading(false), 300);
            });
        });
    }

    // Initialize search functionality
    initializeSearch() {
        this.searchInput = document.getElementById("searchKantor");

        if (!this.searchInput) {
            console.error("Search input element not found");
            return;
        }

        this.searchInput.addEventListener(
            "input",
            this.debounce((e) => {
                this.showLoading(true);
                this.filterTableRows();
                setTimeout(() => this.showLoading(false), 300);
            }, 300),
        );
    }

    // Filter table rows based on current filter and search term
    filterTableRows() {
        const searchTerm = this.searchInput
            ? this.searchInput.value.toLowerCase()
            : "";
        const rows = document.querySelectorAll(".kantor-row");
        let visibleCount = 0;

        rows.forEach((row) => {
            const type = row.dataset.type || "cabang";
            const nama = row
                .querySelector("td:nth-child(3)")
                .textContent.toLowerCase();
            const alamat = row
                .querySelector("td:nth-child(4)")
                .textContent.toLowerCase();
            const kota =
                row
                    .querySelector("td:nth-child(4) .kantor-kota")
                    ?.textContent.toLowerCase() || "";

            const matchesFilter =
                this.activeFilter === "all" || type === this.activeFilter;
            const matchesSearch =
                !searchTerm ||
                nama.includes(searchTerm) ||
                alamat.includes(searchTerm) ||
                kota.includes(searchTerm);

            if (matchesFilter && matchesSearch) {
                row.style.display = "";
                row.classList.add("kantor-visible");
                row.classList.remove("kantor-hidden");
                visibleCount++;
            } else {
                row.style.display = "none";
                row.classList.remove("kantor-visible");
                row.classList.add("kantor-hidden");
            }
        });

        // Show empty state if no rows visible
        this.showEmptyState(visibleCount === 0);

        // Update counter
        this.updateResultCounter(visibleCount);
    }

    // Update statistics display
    updateStatistics() {
        const statsElements = document.querySelectorAll(".stat-number");

        if (statsElements.length >= 3) {
            const allKantor = this.kantorData.filter((k) =>
                this.matchesCurrentFilter(k),
            );
            const cabangKantor = this.kantorData.filter(
                (k) => k.type === "cabang" && this.matchesCurrentFilter(k),
            );
            const kasKantor = this.kantorData.filter(
                (k) => k.type === "kas" && this.matchesCurrentFilter(k),
            );
            const pusatKantor = this.kantorData.filter(
                (k) => k.type === "pusat" && this.matchesCurrentFilter(k),
            );

            statsElements[0].textContent = allKantor.length;
            statsElements[1].textContent = cabangKantor.length;
            statsElements[2].textContent = kasKantor.length;

            // If there's a fourth stat element for pusat
            if (statsElements[3]) {
                statsElements[3].textContent = pusatKantor.length;
            }
        }
    }

    // Check if kantor matches current filter and search
    matchesCurrentFilter(kantor) {
        const searchTerm = this.searchInput
            ? this.searchInput.value.toLowerCase()
            : "";

        const matchesFilter =
            this.activeFilter === "all" || kantor.type === this.activeFilter;

        if (!searchTerm) return matchesFilter;

        const matchesSearch =
            kantor.nama.toLowerCase().includes(searchTerm) ||
            kantor.alamat.toLowerCase().includes(searchTerm) ||
            kantor.kota.toLowerCase().includes(searchTerm) ||
            kantor.kode.toLowerCase().includes(searchTerm);

        return matchesFilter && matchesSearch;
    }

    // Update result counter
    updateResultCounter(count) {
        const counter = document.getElementById("resultCounter");
        const total = this.kantorData.length;

        if (counter) {
            if (this.activeFilter === "all" && !this.searchInput.value) {
                counter.textContent = `Menampilkan semua ${total} kantor`;
            } else {
                counter.textContent = `Menampilkan ${count} dari ${total} kantor`;
            }
        }
    }

    // Show/hide empty state
    showEmptyState(show) {
        let emptyState = document.querySelector(".empty-state-row");

        if (show && !emptyState) {
            const tbody =
                document.getElementById("kantorTableBody") ||
                document.querySelector(".table tbody");

            if (!tbody) return;

            emptyState = document.createElement("tr");
            emptyState.className = "empty-state-row";
            emptyState.innerHTML = `
                <td colspan="6">
                    <div class="empty-state text-center py-5">
                        <div class="empty-state-icon mb-3">
                            <i class="bi bi-search display-4 text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-2">Kantor Tidak Ditemukan</h4>
                        <p class="text-muted mb-4">Tidak ada kantor yang sesuai dengan pencarian Anda.</p>
                        <button class="btn btn-primary" onclick="jaringanKantor.resetFilters()">
                            <i class="bi bi-arrow-clockwise me-2"></i> Reset Pencarian
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(emptyState);
        } else if (!show && emptyState) {
            emptyState.remove();
        }
    }

    // Reset all filters
    resetFilters() {
        if (this.searchInput) {
            this.searchInput.value = "";
        }

        const allFilterBtn = document.querySelector(
            '.filter-btn[data-filter="all"]',
        );
        if (allFilterBtn) {
            allFilterBtn.click();
        } else {
            this.activeFilter = "all";
            this.filterTableRows();
            this.updateStatistics();
        }

        // Focus on search input
        if (this.searchInput) {
            this.searchInput.focus();
        }
    }

    // Show/hide loading spinner
    showLoading(show) {
        const spinner = document.getElementById("loadingSpinner");
        const table =
            document.getElementById("kantorTable") ||
            document.querySelector(".table-responsive");

        if (spinner) {
            spinner.style.display = show ? "flex" : "none";
        }

        if (table) {
            table.style.opacity = show ? "0.6" : "1";
            table.style.pointerEvents = show ? "none" : "auto";
        }
    }

    // Open map modal with kantor data
    openMapModal(kantor) {
        this.currentKantor = kantor;

        // Update modal content
        this.updateModalContent(kantor);

        // Show modal first
        const modalElement = document.getElementById("mapModal");
        if (!modalElement) return;

        const modal = new bootstrap.Modal(modalElement);
        modal.show();

        // Initialize map after modal is shown
        setTimeout(() => {
            this.initializeMap();

            // Clear existing markers
            this.clearMarkers();

            // Add marker for current kantor
            if (kantor.lat && kantor.lng) {
                const marker = this.addMarker(kantor.lat, kantor.lng, kantor);
                this.map.setView([kantor.lat, kantor.lng], 15);

                // Open popup after a short delay
                setTimeout(() => {
                    if (marker) {
                        marker.openPopup();
                    }
                }, 500);
            } else {
                // Use geocoding to get coordinates from address
                this.geocodeAddress(kantor);
            }
        }, 300);
    }

    // Update modal content
    updateModalContent(kantor) {
        const modalKantorName = document.getElementById("modalKantorName");
        const modalKantorFullName = document.getElementById(
            "modalKantorFullName",
        );
        const modalKantorAlamat = document.getElementById("modalKantorAlamat");
        const modalKantorKota = document.getElementById("modalKantorKota");
        const modalKantorTelepon =
            document.getElementById("modalKantorTelepon");
        const modalKantorJam = document.getElementById("modalKantorJam");
        const modalKantorTipe = document.getElementById("modalKantorTipe");

        if (modalKantorName) modalKantorName.textContent = kantor.nama;
        if (modalKantorFullName) modalKantorFullName.textContent = kantor.nama;
        if (modalKantorAlamat) modalKantorAlamat.textContent = kantor.alamat;
        if (modalKantorKota) modalKantorKota.textContent = kantor.kota || "NTB";
        if (modalKantorTelepon)
            modalKantorTelepon.textContent = kantor.telepon || "Tidak tersedia";
        if (modalKantorJam)
            modalKantorJam.textContent =
                kantor.jam || "08:00 - 16:00 (Senin-Jumat)";

        // Update badge type
        if (modalKantorTipe) {
            modalKantorTipe.textContent = this.getKantorTypeLabel(kantor.type);
            modalKantorTipe.className =
                "badge " + this.getKantorTypeClass(kantor.type);
        }
    }

    // Initialize Leaflet map
    initializeMap() {
        const mapElement = document.getElementById("map");
        if (!mapElement) {
            console.error("Map element not found");
            return null;
        }

        // Clear existing map if exists
        if (this.map) {
            this.map.remove();
            this.map = null;
        }

        // Initialize new map
        try {
            // Default to NTB center coordinates
            const defaultCoords = [-8.5833, 116.1167];

            // Initialize map with options
            this.map = L.map("map", {
                center: defaultCoords,
                zoom: 10,
                zoomControl: true,
                attributionControl: true,
                scrollWheelZoom: true,
                dragging: true,
                tap: true,
            }).setView(defaultCoords, 10);

            // Add OpenStreetMap tile layer
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
                detectRetina: true,
                updateWhenIdle: true,
                updateWhenZooming: false,
                keepBuffer: 2,
            }).addTo(this.map);

            // Add scale control
            L.control
                .scale({
                    imperial: false,
                    position: "bottomleft",
                })
                .addTo(this.map);

            // Add zoom control
            L.control
                .zoom({
                    position: "topright",
                })
                .addTo(this.map);

            // Invalidate size to ensure proper rendering
            setTimeout(() => {
                if (this.map) {
                    this.map.invalidateSize();
                }
            }, 100);

            console.log("Leaflet map initialized successfully");
            return this.map;
        } catch (error) {
            console.error("Error initializing map:", error);
            return null;
        }
    }

    // Add marker to map with custom icon and popup
    addMarker(lat, lng, kantor) {
        if (!this.map) {
            console.error("Map not initialized");
            return null;
        }

        try {
            // Create custom icon
            const icon = this.createMarkerIcon(kantor.type);

            // Create marker with options
            const marker = L.marker([lat, lng], {
                icon: icon,
                title: kantor.nama,
                alt: kantor.nama,
                riseOnHover: true,
                keyboard: true,
            }).addTo(this.map);

            // Create popup content
            const popupContent = this.createPopupContent(kantor);

            // Bind popup with options
            marker.bindPopup(popupContent, {
                maxWidth: 300,
                minWidth: 250,
                maxHeight: 400,
                autoPan: true,
                autoPanPadding: [50, 50],
                closeButton: true,
                autoClose: false,
                closeOnEscapeKey: true,
                className: "kantor-popup",
            });

            // Store marker reference
            this.markers.push(marker);

            // Add click event to marker
            marker.on("click", () => {
                marker.openPopup();
            });

            console.log(`Marker added for ${kantor.nama} at ${lat}, ${lng}`);
            return marker;
        } catch (error) {
            console.error("Error adding marker:", error);
            return null;
        }
    }

    // Create custom marker icon
    createMarkerIcon(kantorType) {
        const iconColor = this.getMarkerColor(kantorType);
        const iconClass = this.getMarkerIconClass(kantorType);

        return L.divIcon({
            html: `
                <div class="custom-marker" style="background-color: ${iconColor};">
                    <i class="${iconClass}"></i>
                </div>
            `,
            className: "custom-marker-container",
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            popupAnchor: [0, -35],
        });
    }

    // Get marker icon class based on kantor type
    getMarkerIconClass(type) {
        const icons = {
            pusat: "bi bi-building-fill",
            cabang: "bi bi-shop",
            kas: "bi bi-bank",
        };

        return icons[type] || "bi bi-building";
    }

    // Get marker color based on kantor type
    getMarkerColor(type) {
        const colors = {
            pusat: "#1a3a8f", // Primary blue
            cabang: "#ffc107", // Warning yellow
            kas: "#198754", // Success green
        };

        return colors[type] || "#6c757d"; // Default gray
    }

    // Create popup content for marker
    createPopupContent(kantor) {
        return `
            <div class="leaflet-popup-content">
                <div class="popup-header">
                    <h6 class="mb-1 fw-bold">${this.escapeHtml(kantor.nama)}</h6>
                    <span class="badge ${this.getKantorTypeClass(kantor.type)}">
                        ${this.getKantorTypeLabel(kantor.type)}
                    </span>
                </div>
                <div class="popup-body">
                    <p class="mb-2 small">
                        <i class="bi bi-geo-alt me-1"></i>
                        ${this.escapeHtml(kantor.alamat)}
                    </p>
                    ${
                        kantor.kota
                            ? `
                        <p class="mb-2 small">
                            <i class="bi bi-geo me-1"></i>
                            ${this.escapeHtml(kantor.kota)}
                        </p>
                    `
                            : ""
                    }
                    ${
                        kantor.telepon
                            ? `
                        <p class="mb-2 small">
                            <i class="bi bi-telephone me-1"></i>
                            ${this.escapeHtml(kantor.telepon)}
                        </p>
                    `
                            : ""
                    }
                    ${
                        kantor.jam
                            ? `
                        <p class="mb-2 small">
                            <i class="bi bi-clock me-1"></i>
                            ${this.escapeHtml(kantor.jam)}
                        </p>
                    `
                            : ""
                    }
                </div>
                <div class="popup-footer">
                    <button class="btn btn-sm btn-primary w-100" 
                            onclick="jaringanKantor.getDirections(${kantor.lat}, ${kantor.lng}, '${this.escapeHtml(kantor.nama)}')">
                        <i class="bi bi-compass me-1"></i> Dapatkan Rute
                    </button>
                </div>
            </div>
        `;
    }

    // Escape HTML to prevent XSS
    escapeHtml(text) {
        const div = document.createElement("div");
        div.textContent = text;
        return div.innerHTML;
    }

    // Get kantor type label
    getKantorTypeLabel(type) {
        const labels = {
            pusat: "Kantor Pusat",
            cabang: "Kantor Cabang",
            kas: "Kantor Kas",
        };

        return labels[type] || "Kantor";
    }

    // Get kantor type CSS class
    getKantorTypeClass(type) {
        const classes = {
            pusat: "badge-kantor-pusat",
            cabang: "badge-kantor-cabang",
            kas: "badge-kantor-kas",
        };

        return classes[type] || "badge-secondary";
    }

    // Geocode address to get coordinates
    async geocodeAddress(kantor) {
        const address = `${kantor.alamat}, ${kantor.kota}, NTB, Indonesia`;

        console.log(`Geocoding: ${address}`);

        // Show loading on map
        this.showMapLoading(true);

        try {
            // Using OpenStreetMap Nominatim API
            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1&countrycodes=id`;

            const response = await fetch(url, {
                headers: {
                    "User-Agent": "BPRNTB-JaringanKantor/1.0",
                    "Accept-Language": "id",
                },
            });

            const data = await response.json();

            if (data && data.length > 0) {
                const lat = parseFloat(data[0].lat);
                const lng = parseFloat(data[0].lon);

                console.log(`Geocoded successfully: ${lat}, ${lng}`);

                // Add marker with coordinates
                const marker = this.addMarker(lat, lng, kantor);
                this.map.setView([lat, lng], 15);

                // Open popup
                setTimeout(() => {
                    if (marker) {
                        marker.openPopup();
                    }
                }, 500);
            } else {
                console.warn("Geocoding failed, using default coordinates");
                this.addDefaultMarker(kantor);
            }
        } catch (error) {
            console.error("Geocoding error:", error);
            this.addDefaultMarker(kantor);
        } finally {
            this.showMapLoading(false);
        }
    }

    // Add marker at default location
    addDefaultMarker(kantor) {
        // Use NTB center coordinates as default
        const defaultCoords = [-8.5833, 116.1167];
        const marker = this.addMarker(
            defaultCoords[0],
            defaultCoords[1],
            kantor,
        );
        this.map.setView(defaultCoords, 10);

        // Open popup
        setTimeout(() => {
            if (marker) {
                marker.openPopup();
            }
        }, 500);
    }

    // Clear all markers from map
    clearMarkers() {
        this.markers.forEach((marker) => {
            if (marker && this.map) {
                this.map.removeLayer(marker);
            }
        });
        this.markers = [];
    }

    // Show loading on map
    showMapLoading(show) {
        const mapElement = document.getElementById("map");
        if (!mapElement) return;

        if (show) {
            let loadingDiv = document.getElementById("mapLoading");
            if (!loadingDiv) {
                loadingDiv = document.createElement("div");
                loadingDiv.id = "mapLoading";
                loadingDiv.className = "map-loading-overlay";
                loadingDiv.innerHTML = `
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading peta...</span>
                    </div>
                `;
                mapElement.appendChild(loadingDiv);
            }
        } else {
            const loadingDiv = document.getElementById("mapLoading");
            if (loadingDiv) {
                loadingDiv.remove();
            }
        }
    }

    // Get directions using Google Maps
    getDirections(lat, lng, kantorName = "") {
        if (!lat || !lng) {
            alert("Koordinat tidak tersedia untuk kantor ini.");
            return;
        }

        const destination = encodeURIComponent(`${lat},${lng}`);
        const name = kantorName ? encodeURIComponent(kantorName) : "";
        const url = `https://www.google.com/maps/dir/?api=1&destination=${destination}&destination_place_id=&travelmode=driving`;

        window.open(url, "_blank", "noopener,noreferrer");
    }

    // Share location
    shareLocation() {
        if (!this.currentKantor) return;

        if (navigator.share) {
            navigator
                .share({
                    title: `Lokasi ${this.currentKantor.nama}`,
                    text: `${this.currentKantor.nama} - ${this.currentKantor.alamat}, ${this.currentKantor.kota}`,
                    url: window.location.href,
                })
                .catch((error) => {
                    console.log("Sharing cancelled or failed:", error);
                });
        } else {
            // Fallback: copy to clipboard
            const text = `${this.currentKantor.nama}\n${this.currentKantor.alamat}\n${this.currentKantor.kota}`;
            navigator.clipboard
                .writeText(text)
                .then(() => {
                    this.showToast(
                        "Alamat telah disalin ke clipboard!",
                        "success",
                    );
                })
                .catch((err) => {
                    console.error("Failed to copy:", err);
                    this.showToast("Gagal menyalin alamat", "error");
                });
        }
    }

    // Show toast notification
    showToast(message, type = "info") {
        const toastHtml = `
            <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;

        const toastContainer =
            document.getElementById("toastContainer") ||
            (() => {
                const container = document.createElement("div");
                container.id = "toastContainer";
                container.className =
                    "toast-container position-fixed top-0 end-0 p-3";
                container.style.zIndex = "9999";
                document.body.appendChild(container);
                return container;
            })();

        const toastElement = document.createElement("div");
        toastElement.innerHTML = toastHtml;
        toastContainer.appendChild(toastElement.firstElementChild);

        const toast = new bootstrap.Toast(toastElement.firstElementChild);
        toast.show();

        // Remove toast after it hides
        toastElement.firstElementChild.addEventListener(
            "hidden.bs.toast",
            () => {
                toastElement.remove();
            },
        );
    }

    // Initialize export functionality
    initializeExport() {
        const exportBtn = document.getElementById("exportBtn");
        if (exportBtn) {
            exportBtn.addEventListener("click", () => this.exportToExcel());
        }
    }

    // Export to Excel
    exportToExcel() {
        // This is a simplified version - you might want to use a library like SheetJS
        const visibleKantor = Array.from(
            document.querySelectorAll(".kantor-row.kantor-visible"),
        ).map((row) => {
            const cells = row.querySelectorAll("td");
            return {
                nama: cells[2]?.textContent.trim() || "",
                tipe: row.dataset.type || "",
                alamat: cells[3]?.textContent.trim() || "",
                telepon: cells[4]?.textContent.trim() || "",
            };
        });

        if (visibleKantor.length === 0) {
            this.showToast("Tidak ada data untuk diekspor", "warning");
            return;
        }

        console.log("Exporting data:", visibleKantor);
        this.showToast(`Mengekspor ${visibleKantor.length} kantor...`, "info");

        // Implement actual Excel export here using SheetJS
        // Example with SheetJS:
        // const wb = XLSX.utils.book_new();
        // const ws = XLSX.utils.json_to_sheet(visibleKantor);
        // XLSX.utils.book_append_sheet(wb, ws, "Jaringan Kantor");
        // XLSX.writeFile(wb, "jaringan-kantor-bpr-ntb.xlsx");
    }

    // Setup additional event listeners
    setupEventListeners() {
        // Keyboard shortcuts
        document.addEventListener("keydown", (e) => {
            // Ctrl/Cmd + F to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === "f") {
                e.preventDefault();
                if (this.searchInput) {
                    this.searchInput.focus();
                    this.searchInput.select();
                }
            }

            // Escape to reset filters
            if (e.key === "Escape") {
                this.resetFilters();
            }
        });

        // Handle window resize
        window.addEventListener(
            "resize",
            this.debounce(() => {
                if (this.map) {
                    this.map.invalidateSize();
                }
            }, 250),
        );
    }

    // Debounce function
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

// Initialize the application
const jaringanKantor = new JaringanKantor();

// Make functions globally available
window.openMapModal = (kantor) => jaringanKantor.openMapModal(kantor);
window.resetFilters = () => jaringanKantor.resetFilters();
window.getDirections = (lat, lng, kantorName) =>
    jaringanKantor.getDirections(lat, lng, kantorName);
window.shareLocation = () => jaringanKantor.shareLocation();

// Initialize when document is ready
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", () => {
        jaringanKantor.init();
    });
} else {
    jaringanKantor.init();
}

// Add additional CSS for map styling
const addMapStyles = () => {
    const style = document.createElement("style");
    style.textContent = `
        /* Custom marker styles */
        .custom-marker-container {
            background: none !important;
            border: none !important;
        }
        
        .custom-marker {
            width: 40px;
            height: 40px;
            border-radius: 50% 50% 50% 0;
            background: #1a3a8f;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            border: 3px solid white;
            cursor: pointer;
            transition: all 0.2s ease;
            transform: rotate(-45deg);
        }
        
        .custom-marker i {
            transform: rotate(45deg);
        }
        
        .custom-marker:hover {
            transform: rotate(-45deg) scale(1.1);
        }
        
        /* Popup styles */
        .leaflet-popup-content {
            margin: 0;
            padding: 0;
            width: 100% !important;
        }
        
        .leaflet-popup-content-wrapper {
            border-radius: 8px;
            padding: 0;
            overflow: hidden;
        }
        
        .kantor-popup .popup-header {
            background: linear-gradient(135deg, #1a3a8f 0%, #2c5282 100%);
            color: white;
            padding: 12px 15px;
        }
        
        .kantor-popup .popup-header h6 {
            margin: 0;
            font-size: 0.95rem;
        }
        
        .kantor-popup .popup-body {
            padding: 15px;
        }
        
        .kantor-popup .popup-footer {
            padding: 10px 15px;
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }
        
        /* Loading overlay */
        .map-loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            border-radius: 8px;
        }
        
        /* Map container */
        #map {
            border-radius: 8px;
            z-index: 1;
        }
        
        /* Animation for table rows */
        .kantor-hidden {
            display: none;
        }
        
        .kantor-visible {
            display: table-row;
            animation: fadeInRow 0.3s ease-out;
        }
        
        @keyframes fadeInRow {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Leaflet controls */
        .leaflet-control-zoom {
            border: none !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
            border-radius: 8px !important;
            overflow: hidden;
        }
        
        .leaflet-control-zoom a {
            background-color: white !important;
            color: #1a3a8f !important;
            border-bottom: 1px solid #dee2e6 !important;
            width: 35px !important;
            height: 35px !important;
            line-height: 35px !important;
        }
        
        .leaflet-control-zoom a:hover {
            background-color: #f8f9fa !important;
        }
        
        /* Toast container */
        .toast-container {
            z-index: 9999;
        }
    `;
    document.head.appendChild(style);
};

// Add the styles
addMapStyles();

// Debug function to check if Leaflet is loaded
window.checkLeaflet = () => {
    if (typeof L === "undefined") {
        console.error("Leaflet is not loaded!");
        return false;
    }
    console.log("Leaflet version:", L.version);
    return true;
};

// Function to test marker creation
window.testMarker = () => {
    if (!jaringanKantor.map) {
        console.error("Map not initialized");
        return;
    }

    const testKantor = {
        id: "test-1",
        type: "cabang",
        nama: "Kantor Test",
        alamat: "Jl. Test No. 123",
        kota: "Mataram",
        telepon: "0370-123456",
        jam: "08:00 - 16:00",
        lat: -8.5833,
        lng: 116.1167,
    };

    const marker = jaringanKantor.addMarker(
        testKantor.lat,
        testKantor.lng,
        testKantor,
    );
    if (marker) {
        setTimeout(() => {
            marker.openPopup();
        }, 500);
    }
};
