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
        //QUERY TO GET TITLE AND YEAR OF ALBUM
        $album = $_POST['item'];
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
        //QUERY TO GET LIST OF SONGS OF AN ALBUM
        $album = $_POST['item'];
        $sql = "SELECT DISTINCT song.name as 'song' FROM song INNER JOIN catalogue ON song.id = catalogue.song_fk 
        AND catalogue.album_fk = " . $album;

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
        //QUERY TO GET LENGHT IN TIME OF THE ALBUM
        $album = $_POST['item'];

        $sql = "SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( song.length ) ) ) AS timeSum 
        FROM (SELECT catalogue.album_fk, catalogue.song_fk FROM `catalogue` WHERE catalogue.album_fk = "
        . $album ." GROUP BY catalogue.song_fk) as temp INNER JOIN song ON song.id = temp.song_fk";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $res = '<p><b>Total length:</b> ' . $row["timeSum"] . '</p>';
            }
        } else {
            echo "0 results";
        }

        //QUERY TO GET LIST OF STUDIOS AND LOCATIONS WHERE THE ALBUM WAS RECORDED
        $res = $res . "<b>Recorded at the following studios:</b> ";
        $sql = "SELECT studio.name as 'studio', studio.location FROM studio INNER JOIN album_studio 
        ON studio.id = album_studio.studio_fk AND album_studio.album_fk = " . $album;

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
    else if($option == 4){
        //QUERY TO GET LENGHT IN TIME OF THE ALBUM
        $album = $_POST['item'];

        $sql = "SELECT COUNT(DISTINCT catalogue.song_fk) as 'total' FROM catalogue WHERE catalogue.album_fk = ". $album;

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $res = '<p><b>Number of tracks:</b> ' . $row["total"] . '</p>';
            }
        } else {
            echo "0 results";
        }

        //QUERY TO GET LIST OF STUDIOS AND LOCATIONS WHERE THE ALBUM WAS RECORDED
        $sql = "SELECT COUNT(*) as 'total' FROM (SELECT DISTINCT catalogue.song_fk FROM catalogue WHERE catalogue.album_fk = ". $album 
        .") as temp INNER JOIN song_instrument ON temp.song_fk = song_instrument.song_fk";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $res = $res . '<p><b>Amount of instruments played:</b> ' . $row["total"] . '</p>';
            }
            
            echo $res;
        } else {
            echo "0 results";
        }

    }
    else if($option == 5){
        //QUERY TO GET THE ID OF THE SONG
        $song = $_POST['item'];
        $songID = null;

        $sql = 'SELECT id FROM song WHERE name = "' . $song . '"';

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $songID = $row["id"];
            }
        } else {
            echo "0 results";
        }

        //QUERY TO GET THE PLAYED INSTRUMENT AND PLAYERS FOR A GIVEN SONG
        $sql = "SELECT temp.instrument, beatle.name, beatle.lastname FROM (SELECT instrument.name as 'instrument', instrument.player_fk 
        FROM song_instrument INNER JOIN instrument ON song_instrument.instrument_fk = instrument.id AND song_instrument.song_fk = "
        . $songID .") as temp INNER JOIN beatle ON temp.player_fk = beatle.id";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            $res = array('<b>John Lennon:</b> ', '<b>Paul McCartney:</b> ', '<b>George Harrison:</b> ', '<b>Ringo Starr:</b> ', '<b>Other:</b> ');
            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                if($row["lastname"] == "Lennon") $res[0] = $res[0] . $row["instrument"] . ", ";
                else if($row["lastname"] == "McCartney") $res[1] = $res[1] . $row["instrument"] . ", ";
                else if($row["lastname"] == "Harrison") $res[2] = $res[2] . $row["instrument"] . ", ";
                else if($row["lastname"] == "Starr") $res[3] = $res[3] . $row["instrument"] . ", ";
                else if($row["lastname"] == "Other") $res[4] = $res[4] . $row["instrument"] . ", ";
            }
            
            $replace = "";

            foreach($res as $resp){
                
                if(substr_compare($resp, ", ", -2) == 0){
                    $resp = substr($resp, 0, -2).$replace;
                    echo '<p class="songPlayer">' . $resp . '</p>';
                }
            }
        } else {
            echo "0 results";
        }
    }
    else if($option == 6){
        //QUERY TO GET THE ID OF THE SONG
        $song = $_POST['item'];
        $songID = null;

        $sql = 'SELECT id FROM song WHERE name = "' . $song . '"';

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $songID = $row["id"];
            }
        } else {
            echo "0 results";
        }

        //QUERY TO GET THE LENGTH OF THE SONG
        $sql = "SELECT song.length FROM song WHERE song.id = ". $songID;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                echo '<p><b>Length: </b>' . $row["length"] . '</p>';
            }
        } else {
            echo "0 results";
        }
        //QUERY TO GET THE NUMBER OF INSTRUMENTS PLAYED IN THE SONG
        $sql = "SELECT COUNT(*) as total FROM song_instrument WHERE song_instrument.song_fk = ". $songID;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                echo '<p><b>Amount of instruments played: </b>' . $row["total"] . '</p>';
            }
        } else {
            echo "0 results";
        }
        //QUERY TO GET THE SONGWRITERS
        $resp = "<p><b>Songwriters: </b>";
        $sql = "SELECT beatle.name, beatle.lastname FROM beatle INNER JOIN catalogue ON catalogue.writer_fk = beatle.id 
        AND catalogue.song_fk = ". $songID;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                $resp = $resp . $row["name"] . ' '. $row["lastname"] . ', ';
            }
            $replace = "";
            $resp = substr($resp, 0, -2).$replace;
            echo $resp . '</p>';
        } else {
            echo "0 results";
        }
    }
    
    else if($option == 91){
        //QUERY TO AMOUNT OF INSTRUMENTS PLAYED BY LENNON ON THE ALBUM
        $album = $_POST['item'];
        $resp = null;

        $sql = "SELECT COUNT(*) as 'total' FROM catalogue WHERE catalogue.writer_fk = 1 AND catalogue.album_fk = ". $album;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . '<p>He wrote ' . $row["total"] . ' different songs in this album.</p>';
            }
        } else {
            echo "0 results";
        }


        $sql = "SELECT COUNT(*) as 'total'
        FROM (SELECT DISTINCT song_instrument.instrument_fk FROM catalogue INNER JOIN song_instrument ON catalogue.album_fk = "
        . $album . " AND catalogue.song_fk = song_instrument.song_fk) as temp INNER JOIN instrument
        ON temp.instrument_fk = instrument.id AND instrument.player_fk = 1";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . '<p>He played ' . $row["total"] . ' different instruments in this album.</p>';
            }
            echo $resp;
        } else {
            echo "0 results";
        }
    }
    else if($option == 92){
        //QUERY TO AMOUNT OF INSTRUMENTS PLAYED BY MACCA ON THE ALBUM
        $album = $_POST['item'];
        $resp = null;

        $sql = "SELECT COUNT(*) as 'total' FROM catalogue WHERE catalogue.writer_fk = 2 AND catalogue.album_fk = ". $album;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . '<p>He wrote ' . $row["total"] . ' different songs in this album.</p>';
            }
        } else {
            echo "0 results";
        }


        $sql = "SELECT COUNT(*) as 'total'
        FROM (SELECT DISTINCT song_instrument.instrument_fk FROM catalogue INNER JOIN song_instrument ON catalogue.album_fk = "
        . $album . " AND catalogue.song_fk = song_instrument.song_fk) as temp INNER JOIN instrument
        ON temp.instrument_fk = instrument.id AND instrument.player_fk = 2";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . '<p>He played ' . $row["total"] . ' different instruments in this album.</p>';
            }
            echo $resp;
        } else {
            echo "0 results";
        }
    }
    else if($option == 93){
        //QUERY TO AMOUNT OF INSTRUMENTS PLAYED BY HARRISON ON THE ALBUM
        $album = $_POST['item'];
        $resp = null;

        $sql = "SELECT COUNT(*) as 'total' FROM catalogue WHERE catalogue.writer_fk = 3 AND catalogue.album_fk = ". $album;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . '<p>He wrote ' . $row["total"] . ' different songs in this album.</p>';
            }
        } else {
            echo "0 results";
        }


        $sql = "SELECT COUNT(*) as 'total'
        FROM (SELECT DISTINCT song_instrument.instrument_fk FROM catalogue INNER JOIN song_instrument ON catalogue.album_fk = "
        . $album . " AND catalogue.song_fk = song_instrument.song_fk) as temp INNER JOIN instrument
        ON temp.instrument_fk = instrument.id AND instrument.player_fk = 3";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . '<p>He played ' . $row["total"] . ' different instruments in this album.</p>';
            }
            echo $resp;
        } else {
            echo "0 results";
        }
    }
    else if($option == 94){
        //QUERY TO AMOUNT OF INSTRUMENTS PLAYED BY STARR ON THE ALBUM
        $album = $_POST['item'];
        $resp = null;

        $sql = "SELECT COUNT(*) as 'total' FROM catalogue WHERE catalogue.writer_fk = 4 AND catalogue.album_fk = ". $album;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . '<p>He wrote ' . $row["total"] . ' different songs in this album.</p>';
            }
        } else {
            echo "0 results";
        }


        $sql = "SELECT COUNT(*) as 'total'
        FROM (SELECT DISTINCT song_instrument.instrument_fk FROM catalogue INNER JOIN song_instrument ON catalogue.album_fk = "
        . $album . " AND catalogue.song_fk = song_instrument.song_fk) as temp INNER JOIN instrument
        ON temp.instrument_fk = instrument.id AND instrument.player_fk = 4";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . '<p>He played ' . $row["total"] . ' different instruments in this album.</p>';
            }
            echo $resp;
        } else {
            echo "0 results";
        }
    }
    
    else if($option == 95){
        //QUERY TO AMOUNT OF INSTRUMENTS PLAYED AND SONGWRITING BY LENNON

        $resp = null;
        
        $sql = "SELECT COUNT(*) as total FROM catalogue WHERE catalogue.writer_fk = 1";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = '<p>He has writen ' . $row["total"] . ' different songs throughout the Beatles history.</p>';
            }
        } else {
            echo "0 results";
        }

        $sql = "SELECT COUNT(*) as total FROM instrument WHERE player_fk = 1";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . "<p>He has played " . $row["total"]. " different instruments throughout the Beatles history.</p>";
            }
            echo $resp;
        } else {
            echo "0 results";
        }
    }
    else if($option == 96){
        //QUERY TO AMOUNT OF INSTRUMENTS PLAYED AND SONGWRITING BY MACCA

        $resp = null;
        
        $sql = "SELECT COUNT(*) as total FROM catalogue WHERE catalogue.writer_fk = 2";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = '<p>He has writen ' . $row["total"] . ' different songs throughout the Beatles history.</p>';
            }
        } else {
            echo "0 results";
        }

        $sql = "SELECT COUNT(*) as total FROM instrument WHERE player_fk = 2";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . "<p>He has played " . $row["total"]. " different instruments throughout the Beatles history.</p>";
            }
            echo $resp;
        } else {
            echo "0 results";
        }
    }
    else if($option == 97){
        //QUERY TO AMOUNT OF INSTRUMENTS PLAYED AND SONGWRITING BY HARRISON

        $resp = null;
        
        $sql = "SELECT COUNT(*) as total FROM catalogue WHERE catalogue.writer_fk = 3";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = '<p>He has writen ' . $row["total"] . ' different songs throughout the Beatles history.</p>';
            }
        } else {
            echo "0 results";
        }

        $sql = "SELECT COUNT(*) as total FROM instrument WHERE player_fk = 3";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . "<p>He has played " . $row["total"]. " different instruments throughout the Beatles history.</p>";
            }
            echo $resp;
        } else {
            echo "0 results";
        }
    }
    else if($option == 98){
        //QUERY TO AMOUNT OF INSTRUMENTS PLAYED AND SONGWRITING BY STARR

        $resp = null;
        
        $sql = "SELECT COUNT(*) as total FROM catalogue WHERE catalogue.writer_fk = 4";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = '<p>He has writen ' . $row["total"] . ' different songs throughout the Beatles history.</p>';
            }
        } else {
            echo "0 results";
        }

        $sql = "SELECT COUNT(*) as total FROM instrument WHERE player_fk = 4";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resp = $resp . "<p>He has played " . $row["total"]. " different instruments throughout the Beatles history.</p>";
            }
            echo $resp;
        } else {
            echo "0 results";
        }
    }

    $conn->close();

?>

