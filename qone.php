<?php
//checks for user logged in 
session_start();
include("conn.php");
ob_start();
if (!isset($_SESSION['clientloggedin'])) {
    header('location:signup.php');
    ob_end_flush();
    $_SESSION['ClientID'];
} else {
    $user = $_SESSION['clientloggedin'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/facemesh"></script>

    <!-- Load the coco-ssd model. -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd@2.0.3"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="js/volume-meter.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS-->
    <link rel="stylesheet" href="css/stylesheet.css">
    <!--Fontawesome CSS-->
    <script src="https://kit.fontawesome.com/1f937cfd44.js" crossorigin="anonymous"></script>


    <title>QuizCheck</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<!--TODO Checks for usertype then displays 2 options for the navbar; client logged or admin logged in.-->

<!--TODO build brain.js model to train from data -->

<body>

    <!--direct css for box and video (issues as part of css file - Bootstrap compatibility? -->
    <style>
        #container {
            margin: 0px auto;
            width: 200px;
            height: 150px;
            border: 2px #333 solid;
        }

        #videoElement {
            width: 200px;
            height: 150px;
            background-color: #666;
        }
    </style>
    <!--nav bar using Bootstrap-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark   navbar-custom">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-itema">
                    <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-itemb">
                    <a class="nav-link" href="about.php">About</a>
                </li>
        </div>
    </nav>

    <div class="row mt-5"></div>
    <div class="container mt-5"> </div>
    <div class="card-body">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row">
                    <div class="card-body">
                        <div class='col-sm'>
                            <video autoplay="true" id="videoElement">

                            </video>
                        </div>
                    </div>
                </div>

                <!-- TODO get permission at start of session for all screen access, run 
                in background, take screengrab without click if alerts triggered
                <script src=js/screenGrab.js> </script> </html> -->

                </style>

                <div class='row'>

                    <div class='col'>
                        <h1>Quiz one - no cheating!</h1>
                        <p class="lead">
                            <p>
                                <h1> Name the members of the Beatles (first names only):</h1> <br />
                                <div class="row mt-5"></div>
                                <div class="container">
                                    <form action="goal.php" method="POST">

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form-group" placeholder="First" name="first">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form-group" placeholder="Second" name="second">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form-group" placeholder="Third" name="third">
                                            </div>

                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form-group" placeholder="Fourth" name="fourth">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <form class='form-inline my-2 my-lg-0'>
                                                    <a href='qtwo.php' onclick='(endPageTime=dateTime())' class='btn btn-outline-secondary my-2 my-sm-0' name='q1'>Submit</a>
                                                </form>

                                            </div>
                                            <div class="row mt-5"></div>
                                        </div>

                                </div>
                    </div>
                </div>
            </div>



            <footer class="footer">
                <div class="container">
                    <footer class="navbar-fixed-bottom page-footer font-small black darken-3">
                        <div class="container-fluid my-auto">
                            <div class="row">
                                <div class="col-md-4 py-5">
                                </div>
                                <div class="col-md-8 py-5">
                                    <div class="mb-5 flex-center">

                                        <a class="yt-ic" href="https://www.youtube.com/channel/UC0rqucBdTuFTjJiefW5t-IQ">
                                            <i class="fab fa-youtube fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                                        </a>

                                        <a class="li-ic" href="https://www.linkedin.com/in/laurence-fay-37a754109/">
                                            <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                                        </a>

                                    </div>
                                    <div class="footer-copyright" style="color:rgb(112, 156, 142);" href="https://www.tensorflow.org/">
                                        <p>This project uses TensorFlow</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <script src="js/timer.js"></script>
<script src="js/video.js"></script>
<script src="js/videoChecks.js"></script>
<script src="js/visibilityChecks.js"></script>
<script src="js/checkTime.js"></script>

</body>

</html>