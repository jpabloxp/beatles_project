<?php

    $option = $_POST['option'];

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

    if($option == 1){

        $album = $_POST['album'];
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
    }
    else if($option == 2){

        $album = $_POST['album'];
        $sql = "SELECT DISTINCT song.name as 'song' FROM song INNER JOIN catalogue ON song.id = catalogue.song_fk AND catalogue.album_fk = " . $album;

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo $row["song"] . "<br>";
            }
        } else {
            echo "0 results";
        }
    }

?>