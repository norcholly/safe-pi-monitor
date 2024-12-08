<?php require "../src/layouts/_header.php"; ?>

<main>
    <div id="content">
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
                    <form action="/src/Controllers/_date-time-check.php" method="POST">
                        <div>
                            <input id="host" type="text" name="host" placeholder="ip-addr" required>
                        </div>
                        <div>
                            <input id="username" type="text" name="username" placeholder="database-username" required>
                        </div>
                        <div>
                            <input id="password" type="password" name="password" placeholder="database-user-password" required>
                        </div>
                        <div>
                            <input id="database-name" type="text" name="database-name" placeholder="database-name"required>
                        </div>
                        <div>
                            <input id="date" type="date" name="date" placeholder="date" required>
                        </div>
                        <div>
                            <input id="time" type="time" name="time" placeholder="time" required>
                        </div>
                        <div>
                            <button id="check" type="submit">check</button>
                        </div>
                    </form>
                </div>
                <div id="only-day" style="display:none;">
                    <form action="/src/Controllers/_date-check.php" method="post">
                        <div>
                            <input id="host" type="text" name="host" placeholder="ip-addr" required>
                        </div>
                        <div>
                            <input id="username" type="text" name="username" placeholder="database-username" required>
                        </div>
                        <div>
                            <input id="password" type="password" name="password" placeholder="database-user-password" required>
                        </div>
                        <div>
                            <input id="database-name" type="text" name="database-name" placeholder="database-name"required>
                        </div>
                        <div>
                            <input id="date2" type="date" name="date2" placeholder="Date" required>
                        </div>
                        <div>
                            <button id="check" type="submit">check</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require "../src/layouts/_footer.php"; ?>