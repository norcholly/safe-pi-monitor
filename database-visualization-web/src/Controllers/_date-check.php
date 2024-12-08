<link rel="stylesheet" href="../../public/assets/styles.css">

<?php

    // error handling

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     echo "<pre>";
    //     print_r($_POST);
    //     echo "</pre>";
    // }

    // database connection
    $host = $_POST["host"];
    $user = $_POST["username"];
    $password = $_POST["password"];
    $database = $_POST["database-name"];

    // connect
    $conn = new mysqli($host, $user, $password, $database);

    // check the connection
    if ($conn->connect_error) {
        die("connection error: " . $conn->connect_error);
    }

    // query
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date2 = $_POST['date2']; 
        $sql = "SELECT * FROM data WHERE time LIKE '%$date2%'";
        $result = $conn->query($sql);
    }

    $conn->close();

    // output
    require "../Views/_date-check-result.php"

?>

<script src="../../public/assets/script.js"></script>
