function dataCheck() {
    document.getElementById("content").innerHTML = `
        <div id="data-check-page">
            <div id="selection">
                <div>
                    <select id="select" name="select">
                        <option value="0">select</option>
                        <option value="1">date-time</option>
                        <option value="2">date</option>
                    </select>
                </div>
            </div>
            <div id="date-and-time" style="display:none;">
                <form action="">
                    <div>
                        <input id="date" type="date" placeholder="Date" required>
                    </div>
                    <div>
                        <input id="time" type="time" placeholder="Time" required>
                    </div>
                    <div>
                        <button id="check" type="submit">check</button>
                    </div>
                </form>
            </div>
            <div id="only-day" style="display:none;">
                <form action="">
                    <div>
                        <input id="date2" type="date" placeholder="Date" required>
                    </div>
                    <div>
                        <button id="check" type="submit">check</button>
                    </div>
                </form>
            </div>
        </div>
    `;
    addSelectEventListener();
}

function mainCheck() {
    document.getElementById("content").innerHTML = `
        <div id="main-page">
            <article id="descriptions">
                <section class="block">
                    <h3>about-project</h3>
                    <p>This application is the web page of the project that allows the user to easily <span style="color: #00FFFF;">examine the data</span>,
                    with weather data from sensors being processed into a database. The user can either check when
                    specific data arrived, view the graph of the data, or directly browse the entire database.</p>
                </section>
                <section class="block">
                    <h3>about-developer</h3>
                    <p>Ali İrfan Doğan is currently a Management Information Systems student and has been interested in
                    the field of cybersecurity for a long time. The reason for this project is to better understand
                    and learn how security can be ensured in smart systems. At the bottom of the page, you can find
                    buttons that lead to Ali İrfan<span style="color: #00FFFF;">"@norcholly"</span> Doğan's profiles.</p>
                </section>
                <section class="block">
                    <h3>technical-description</h3>
                    <p>This project collects temperature and humidity data using the <span style="color: #00FFFF;">Sense HAT</span>, sends it to the database
                    with Python, and displays the data on the user interface with PHP. The data is stored in a
                    MariaDB database on a Linux server, ensuring real-time environmental monitoring.</p>
                </section>
            </article>
        </div>
    `;
}

function addSelectEventListener() {
    const selectElement = document.getElementById("select");
    if (selectElement) {
        selectElement.addEventListener("change", function() {
            const selectedValue = this.value;
            const dateAndTime = document.getElementById("date-and-time");
            const onlyDay = document.getElementById("only-day");

            if (selectedValue == 1) {
                dateAndTime.style.display = "block";
                onlyDay.style.display = "none";
            } else if (selectedValue == 2) {
                onlyDay.style.display = "block";
                dateAndTime.style.display = "none";
            } else {
                dateAndTime.style.display = "none";
                onlyDay.style.display = "none";
            }
        });
    }
}

window.onload = function() {
    mainCheck();
};