document.addEventListener("DOMContentLoaded", function () {
    const CONFIG = {
        minNominal: {
            tanpa_agunan: 1500000,
            agunan: 5000000,
            konsumtif: 5000000,
        },
        ratesFlat: {
            agunan: [
                { min: 300000000, rate: 12 },
                { min: 60000000, rate: 13 },
                { min: 0, rate: 15 },
            ],
            konsumtif: [
                { min: 125000000, rate: 12 },
                { min: 30000000, rate: 13 },
                { min: 0, rate: 15 },
            ],
            tanpa_agunan: 16,
        },
    };

    const pinjamanInput = document.getElementById("pinjaman");
    const jenisSelect = document.getElementById("jenis_kredit");
    const tenorSelect = document.getElementById("tenor");
    const sistemSelect = document.getElementById("sistem_bunga");
    const bungaInfo = document.getElementById("bunga-info");
    const displayAngsuran = document.getElementById("display_angsuran");
    const summaryPlafond = document.getElementById("summary_plafond");
    const summaryBunga = document.getElementById("summary_bunga");

    const formatIDR = (n) => "Rp " + Math.round(n).toLocaleString("id-ID");
    const parseAngka = (v) => parseInt(v.replace(/[^0-9]/g, "")) || 0;

    pinjamanInput.addEventListener("input", function () {
        let cursorPosition = this.selectionStart;
        let oldLength = this.value.length;
        let rawValue = this.value.replace(/[^0-9]/g, "");

        if (!rawValue) {
            this.value = "";
        } else {
            this.value =
                "Rp " + new Intl.NumberFormat("id-ID").format(rawValue);
        }

        let newPos = cursorPosition + (this.value.length - oldLength);
        this.setSelectionRange(newPos, newPos);

        runCalculations();
    });

    [jenisSelect, tenorSelect, sistemSelect].forEach((el) =>
        el.addEventListener("change", runCalculations)
    );

    function runCalculations() {
        const p = parseAngka(pinjamanInput.value);
        const n = parseInt(tenorSelect.value);
        const jenis = jenisSelect.value;
        const sistem = sistemSelect.value;

        if (p > 0 && n > 0 && jenis) {
            let bungaTahunan = CONFIG.ratesFlat.tanpa_agunan;
            if (jenis !== "tanpa_agunan") {
                const rules = CONFIG.ratesFlat[jenis] || [];
                bungaTahunan = rules.find((r) => p >= r.min)?.rate || 15;
            }

            let angsuran = 0;
            let totalBunga = 0;

            if (sistem === "anuitas" && jenis !== "tanpa_agunan") {
                let i = bungaTahunan / 100 / 12;
                angsuran = p * (i / (1 - Math.pow(1 + i, -n)));
                totalBunga = angsuran * n - p;
            } else {
                let bungaBulan = bungaTahunan / 100 / 12;
                angsuran = p / n + p * bungaBulan;
                totalBunga = p * bungaBulan * n;
            }

            displayAngsuran.textContent = formatIDR(angsuran);
            summaryPlafond.textContent = formatIDR(p);
            summaryBunga.textContent = formatIDR(totalBunga);
            bungaInfo.textContent = `${(bungaTahunan / 12).toFixed(
                3
            )}% / bln (${bungaTahunan}% p.a)`;
        }
    }
});
