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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--gymafi CSS-->
    <link rel="stylesheet" href="css/stylesheet.css">
    <!--Fontawesome CSS-->
    <script src="https://kit.fontawesome.com/1f937cfd44.js" crossorigin="anonymous"></script>


    <title>QuizCheck</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<!--Checks for usertype then displays 2 options for the navbar; client logged or admin logged in.-->

<body>
    <!--direct css for box and video-->
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
            <div class = "row">
    <div class="card-body">
    <div class='col-sm'>
                    <video autoplay="true" id="videoElement">

                        <script>
                            //starts video stream
                            var video = document.querySelector("#videoElement");

                            if (navigator.mediaDevices.getUserMedia) {
                                navigator.mediaDevices.getUserMedia({
                                        video: true
                                    })
                                    .then(function(stream) {
                                        video.srcObject = stream;
                                    })
                                    .catch(function(err0r) {
                                        console.log("Something went wrong!");
                                    });
                            }
                        </script>

                    </video>
                </div></div></div>
<div class ='row'>

                <div class='col'>
                    <h1>Rules of the quiz</h1>
                    <p class="lead">
                        <p> The following quiz is seperated into 2 parts: <br />

                            <p>The first part you should answer only using your own knowledge. DO NOT CHEAT IN ANY WAY.<br />
                                This includes wearing headphones/earphones, opening new tabs,
                                asking another person in the room or looking up the answer on your phone or tablet.
                            </p>
                            <p>The second part you should 100% cheat.<br />
                                This can be asking someone else in the room the answer,
                                googling on a new internet tab
                                or looking up the answer on your phone.</p>

                            <p>Each part has 10 questions and it takes roughly 10 mins to complete the whole quiz</p>
                            <p>During the quiz your web camera is used to identify cheating through movement, object and browser detection</p>
                            <p>When you are ready click the start button to start the quiz</p>

                            <form class='form-inline my-2 my-lg-0'>
                                <a href='qone.php' class='btn btn-outline-secondary my-2 my-sm-0' name='q1'>Start the quiz</a>
                            </form>
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



            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



</body>

</html>