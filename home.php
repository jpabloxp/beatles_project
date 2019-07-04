<?php
    
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
?>

<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        
        <title>The Beatles Project</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="style.css">
        
    </head>
    <body>

        <div class="container">
            <div class="header clearfix">
                <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active"><a href="home.php">Home</a></li>
                    <li role="presentation"><a href="album.php">Albums</a></li>
                    <li role="presentation"><a href="publications.html">Publications</a></li>
                </ul>
                </nav>
                <h3 class="text-muted">The BEATLES project</h3>
            </div>

            <div class="cabecera">

                <div class="jumbotron">
                    <h2>Hi!</h2>
                    <p class="lead">

                        <?php
                            echo "This is my project on the Beatles albums metadata.";
                        ?>
                    </p>
                </div>
            </div>
        
            <div class="row marketing">
                    <div class="col-lg-3">

                        <div class="homePic">
                            <img src = "image/lennon.jpg" class = "img-responsive" alt = "lennonPic">
                        </div>
    
                        <h4>
                            John Lennon
                        </h4>
                        <div class="homeLennon">
                        </div>
                    </div>
                    <div class="col-lg-3">
    
                        <div class="homePic">
                            <img src = "image/macca.jpg" class = "img-responsive" alt = "maccaPic">
                        </div>

                        <h4>Paul McCartney</h4>
                        <div class="homeMacca">
                        </div>
                    </div>
                    <div class="col-lg-3">
    
                        <div class="homePic">
                            <img src = "image/harrison.jpg" class = "img-responsive" alt = "harrisonPic">
                        </div>
                        
                        <h4>George Harrison</h4>
                        <div class="homeHarrison">
                        </div>
                    </div>
                    <div class="col-lg-3">
    
                        <div class="homePic">
                            <img src = "image/ringo.jpg" class = "img-responsive" alt = "ringoPic">
                        </div>
                        
                        <h4>Ringo Starr</h4>
                        <div class="homeRingo">
                        </div>
                    </div>
                <div class="col-lg-12" id="footer">
                    <h3>Contact</h3>
                    
                    <a href="mailto:juan-pablo.rosso@imag.fr">
                        <i class="fa fa-envelope" style="font-size:28px"></i>
                    </a>
                    
                    <a href="https://fr.linkedin.com/in/juan-rosso-6b674b3b/fr">
                        <i class="fa fa-linkedin-square" style="font-size:30px"></i>
                    </a>
                </div>

            </div>
        
            <footer class="footer">
                <p>&copy; Juan Rosso</p>
            </footer>
    
        </div> <!-- /container -->

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <script type="text/javascript" src="homeScript.js"></script>
    </body>
</html>