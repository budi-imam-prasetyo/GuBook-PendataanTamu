import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    var toggle = document.querySelector("[dark-toggle]");
    var themeIcon = document.getElementById("theme-icon");

    // Fungsi untuk memperbarui ikon berdasarkan mode terang/gelap
    function updateIcon() {
        if (toggle.checked) {
            themeIcon.classList.remove("ph ph-sun");
            themeIcon.classList.add("ph ph-moon-stars");
        } else {
            themeIcon.classList.remove("ph ph-moon-stars");
            themeIcon.classList.add("ph ph-sun");
        }
    }

    // Event listener untuk checkbox toggle
    toggle.addEventListener("change", function () {
        updateIcon();
    });

    // Set ikon awal berdasarkan status checkbox
    updateIcon();
});
