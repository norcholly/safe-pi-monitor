<?php require "../src/layouts/_header.php"; ?>

<!-- main page -->
<main>
    <div id="content">
        <div id="main-page" class="page">
            <article id="descriptions">
                <section class="block">
                    <h3>about-project</h3>
                    <p>This application is the web page of the project that allows the user to easily<span style="color: #00FFFF;">examine the data,</span>
                        with weather data from sensors being processed into a database. The user can either check when
                        specific data arrived, view the graph of the data, or directly browse the entire database.</p>
                </section>
                <section class="block">
                    <h3>about-developer</h3>
                    <p>Ali İrfan Doğan is currently a Management Information Systems student and has been interested in
                        the field of cybersecurity for a long time. The reason for this project is to better understand
                        and learn how security can be ensured in smart systems. At the bottom of the page, you can find
                        buttons that lead to Ali İrfan<span style="color: #00FFFF;">"@norcholly"</span>Doğan's profiles.</p>
                </section>
                <section class="block">
                    <h3>technical-description</h3>
                    <p>This project collects temperature and humidity data using the<span style="color: #00FFFF;">Sense HAT,</span>sends it to the database
                        with Python, and displays the data on the user interface with PHP. The data is stored in a
                        MariaDB database on a Linux server, ensuring real-time environmental monitoring.</p>
                </section>
            <article>
        </div>
    </div>
</main>

<?php require "../src/layouts/_footer.php"; ?>