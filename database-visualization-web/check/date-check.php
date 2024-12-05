<?php

    // error handling

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     echo "<pre>";
    //     print_r($_POST);
    //     echo "</pre>";

    //     if (!empty($_POST['date2'])) {
    //         echo "selected date: ".htmlspecialchars($_POST['date2']);
    //     } else {
    //         echo "empty.";
    //     }
    // }

    // database connection 
    $host = "10.0.2.15"; // change hostname
    $user = "data_user"; // change username of database
    $password = "123456"; // change password of database user
    $database = "weather"; // change databasename

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

    // output
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Time</th>
                    <th>Temperature</th>
                    <th>Pressure</th>
                    <th>Humidity</th>
                </tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["time"]."</td>
                    <td>".$row["temperature"]."</td>
                    <td>".$row["pressure"]."</td>
                    <td>".$row["humidity"]."</td>
                  </tr>";
        }
    
        echo "</table>";
    } else {
        echo "no data.";
    }

    $conn->close();
?>
