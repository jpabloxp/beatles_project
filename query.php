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
                echo $row["title"] . " (" . $row["year"] . ")<br>";
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
                echo '<div class="song">' . $row["song"] . '</div>';
            }
        } else {
            echo "0 results";
        }
    }
    else if($option == 3){

        $res = "Recorded at the following studios: ";
        $album = $_POST['album'];
        $sql = "SELECT studio.name as 'studio', studio.location FROM studio INNER JOIN album_studio ON studio.id = album_studio.studio_fk AND album_studio.album_fk = " . $album;

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $res = $res . $row["studio"] . ' (' . $row["location"] . '), ';
            }
            $replace = ".";
            $res = substr($res, 0, -2).$replace;
            echo $res;
        } else {
            echo "0 results";
        }
    }

    
    $conn->close();

?>