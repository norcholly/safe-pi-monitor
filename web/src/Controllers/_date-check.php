<link rel="stylesheet" href="../../public/assets/styles.css">

<?php

    // error handling

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     echo "<pre>";
    //     print_r($_POST);
    //     echo "</pre>";
    // }

    // database connection
    $host = htmlspecialchars($_POST["host"], ENT_QUOTES, 'UTF-8');
    $user = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
    $database = htmlspecialchars($_POST["database-name"], ENT_QUOTES, 'UTF-8');
    $table = htmlspecialchars($_POST["table-name"], ENT_QUOTES, 'UTF-8');
    $date2 = htmlspecialchars($_POST['date2'], ENT_QUOTES, 'UTF-8');

    // connect
    $conn = new mysqli($host, $user, $password, $database);

    // check the connection
    if ($conn->connect_error) {
        die("connection error: " . $conn->connect_error);
    }

    // query
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date2 = htmlspecialchars($_POST['date2'], ENT_QUOTES, 'UTF-8');
        $stmt = $conn->prepare("SELECT * FROM `$table` WHERE `timestamp` LIKE ?");
        $search = "%$date2%";
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    $conn->close();

    // output
    require "../Views/_date-check-result.php"

?>

<script src="../../public/assets/script.js"></script>
