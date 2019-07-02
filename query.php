<?php

    
    $album = $_POST['album'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT name as 'title', year FROM album WHERE id = " . $album;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Album: " . $row["title"] . ". Year: " . $row["year"] . "<br>";
        }
    } else {
        echo "0 results";
    }
?>