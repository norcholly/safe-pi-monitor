function dataCheck() {
    document.getElementById("content").innerHTML = `
        <div id="data-check-page">
            <form action="">
                <div>
                    <label for="date">Date: </label>
                    <input id="date" type="date" placeholder="Date" required>
                </div>
                <div>
                    <label for="time">Time: </label>
                    <input id="time" type="time" placeholder="Time" required>
                </div>
                <div>
                    <button id="check" type="submit">Check</button>
                </div>
            </form>
        </div> 
    `;
}

function mainCheck() {
    document.getElementById("content").innerHTML = `
        <div id="main-page">
            <article id="descriptions">
                <section class="block">
                    <h3>about-project</h3>
                    <p>This application is the web page of the project that allows the user to easily examine the data,
                        with weather data from sensors being processed into a database. The user can either check when
                        specific data arrived, view the graph of the data, or directly browse the entire database.</p>
                </section>
                <section class="block">
                    <h3>about-developer</h3>
                    <p>Ali İrfan Doğan is currently a Management Information Systems student and has been interested in
                        the field of cybersecurity for a long time. The reason for this project is to better understand
                        and learn how security can be ensured in smart systems. At the bottom of the page, you can find
                        buttons that lead to Ali İrfan "@norcholly" Doğan's profiles.</p>
                </section>
                <section class="block">
                    <h3>technical-description</h3>
                    <p>This project collects temperature and humidity data using the Sense HAT, sends it to the database
                        with Python, and displays the data on the user interface with PHP. The data is stored in a
                        MariaDB database on a Linux server, ensuring real-time environmental monitoring.</p>
                </section>
            <article>
        </div>
    `;
}

// function graphCheck() {
//     
// };

// function tableCheck() {
//     
// }