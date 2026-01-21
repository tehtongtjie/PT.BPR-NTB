document.addEventListener("DOMContentLoaded", function () {
    const CONFIG = {
        bungaTenor: {
            1: 5.0,
            3: 5.25,
            6: 5.5,
            12: 6.0,
        },
        minNominal: 5000000,
        thresholdPajak: 7500000,
        ratePajak: 0.2,
    };

    const nominalInput = document.getElementById("nominal");
    const tenorSelect = document.getElementById("tenor");
    const bungaSelect = document.getElementById("bunga");
    const bungaOutput = document.getElementById("estimasi_bunga"); 
    const totalOutput = document.getElementById("total_dana"); 

    const displayBunga = document.getElementById("display_bunga");
    const displayTotal = document.getElementById("display_total");
    const errorText = document.getElementById("nominal-error");

    const formatIDR = (angka) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
        }).format(angka);
    };

    const parseRaw = (str) => parseInt(str.replace(/[^0-9]/g, "")) || 0;

    function hitungDeposito() {
        const nominal = parseRaw(nominalInput.value);
        const tenor = parseInt(tenorSelect.value);

        if (nominal < CONFIG.minNominal && nominal > 0) {
            errorText.classList.remove("d-none");
            nominalInput.classList.add("input-error");
        } else {
            errorText.classList.add("d-none");
            nominalInput.classList.remove("input-error");
        }

        if (!nominal || !tenor || nominal < CONFIG.minNominal) {
            updateDisplay(0, 0);
            return;
        }

        const rateBunga = CONFIG.bungaTenor[tenor] / 100;

        let bungaBruto = nominal * rateBunga * (tenor / 12);

        let pajak = 0;
        if (nominal > CONFIG.thresholdPajak) {
            pajak = bungaBruto * CONFIG.ratePajak;
        }

        const bungaNetto = bungaBruto - pajak;
        const total = nominal + bungaNetto;

        updateDisplay(bungaNetto, total);
    }

    function updateDisplay(bunga, total) {
        const valBunga = bunga > 0 ? formatIDR(Math.floor(bunga)) : "";
        const valTotal = total > 0 ? formatIDR(Math.floor(total)) : "";

        if (bungaOutput) bungaOutput.value = valBunga;
        if (totalOutput) totalOutput.value = valTotal;

        if (displayBunga) displayBunga.innerText = valBunga || "Rp 0";
        if (displayTotal) displayTotal.innerText = valTotal || "Rp 0";
    }

    nominalInput.addEventListener("input", function (e) {
        let cursorStart = this.selectionStart;
        let oldLength = this.value.length;

        let angka = parseRaw(this.value);

        if (angka > 0) {
            this.value = formatIDR(angka).replace("Rp", "").trim();
            this.value = "Rp " + this.value;
        } else {
            this.value = "";
        }

        let newLength = this.value.length;
        cursorStart = cursorStart + (newLength - oldLength);
        this.setSelectionRange(cursorStart, cursorStart);

        hitungDeposito();
    });

    // Event Tenor
    tenorSelect.addEventListener("change", function () {
        const val = this.value;

        // Update field bunga %
        if (val) {
            bungaSelect.value = CONFIG.bungaTenor[val].toFixed(2) + "%";
            this.classList.add("changed");
            setTimeout(() => this.classList.remove("changed"), 400);
        } else {
            bungaSelect.value = "";
        }

        hitungDeposito();
    });
});
