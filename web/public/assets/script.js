document.addEventListener("DOMContentLoaded", function () {
    const selectElement = document.getElementById("select");
    const dateAndTimeDiv = document.getElementById("date-and-time");
    const onlyDayDiv = document.getElementById("only-day");

    if (selectElement) {
        // Dinleyici ekle
        selectElement.addEventListener("change", function () {
            const selectedValue = this.value;

            // Seçime göre bölümleri göster veya gizle
            if (selectedValue === "1") {
                dateAndTimeDiv.style.display = "block";
                onlyDayDiv.style.display = "none";
            } else if (selectedValue === "2") {
                dateAndTimeDiv.style.display = "none";
                onlyDayDiv.style.display = "block";
            } else {
                dateAndTimeDiv.style.display = "none";
                onlyDayDiv.style.display = "none";
            }
        });
    }
});
