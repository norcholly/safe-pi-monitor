<link rel="stylesheet" href="../../public/assets/styles.css">

<?php

    // database connection
    $host = htmlspecialchars($_POST["host"], ENT_QUOTES, 'UTF-8');
    $user = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
    $database = htmlspecialchars($_POST["database-name"], ENT_QUOTES, 'UTF-8');
    $table = htmlspecialchars($_POST["table-name"], ENT_QUOTES, 'UTF-8');

    // connect
    $conn = new mysqli($host, $user, $password, $database);

    // check the connection
    if ($conn->connect_error) {
        die("connection error: " . $conn->connect_error);
    }

    // query
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = htmlspecialchars($_POST["date"], ENT_QUOTES, 'UTF-8');
        $time = htmlspecialchars($_POST["time"], ENT_QUOTES, 'UTF-8');
        $datetime = $date . ' ' . $time;

        // prepared statement
        $stmt = $conn->prepare("SELECT * FROM `$table` WHERE `timestamp` LIKE ?");
        $search = "$datetime%";
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    $conn->close();

    // output
    require "../Views/_date-time-check-result.php"

?>

<script src="../../public/assets/script.js"></script>
