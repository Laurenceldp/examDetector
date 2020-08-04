<?php
session_start();
ob_start();
?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Gymafi CSS -->
  <link rel="stylesheet" href="css/stylesheet.css">
  <!--Fontawesome CSS-->
  <script src="https://kit.fontawesome.com/1f937cfd44.js" crossorigin="anonymous"></script>
  <title>Log in</title>

</head>

<body>
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

  <div class="jumbotron jumbotron-fluid text-center " style="background-color:rgb(6, 50, 56);">

    <h1 style="font-size:15vw" class="text-white " style="background-color:rgb(6, 50, 56);">LOG IN</h1><br>
  </div>
  <!--checks database, verifys password based on comparing a hashed user entry with the 
    hashed entry in the database-->
  <?php
  if (isset($_POST['submit'])) {
    include("conn.php");
    $user = $conn->real_escape_string(trim($_POST['username']));
    $passw = $conn->real_escape_string(trim($_POST['passphrase']));

    $auth = "SELECT * FROM User WHERE Email='$user'";
    $result = $conn->query($auth);
    if (!$result) {
      echo "$conn->error";
    }
    $numrows = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
     // $usertype = $row['UserType'];
      $clientid = $row['UserID'];
      $passr = $row['Password'];
   
    if (password_verify($passw, $passr)) {
      if ($numrows > 0) {        
        $_SESSION['clientloggedin'] = $clientid;
        header('location:start.php');
        ob_end_flush();
      } else {
       echo "<h2 class='pinc text-center' >Password incorrect</h2>";
      } 


  }
}}
  ?>

  <div class="container">

    <form class="form-inline my-2 my-lg-0" action="login.php" method="POST">
      <input class="form-control  col-lg-6" type="email" placeholder="email" name="username" aria-label="Log in" required>
      <input class="form-control  col-lg-6" type="password" placeholder="password" name="passphrase" aria-label="Log in" required>
      <button type="submit" name="submit" class="btn btn-secondary btn-lg btn-block">log in</button>
      <!-- not currently operational
             <p><a href="forgotpassword.php">Forgot your password?</a></p>-->

  </div>

  </form>
  <!--social media links to be updated with JonnyAtomic links before launch-->
  <footer class="footer" style="margin-top:20px;">
    <div class="container">
      <footer class="navbar-fixed-bottom page-footer font-small black darken-3">
        <div class="container-fluid my-auto">
          <div class="row">
            <div class="col-md-4 py-5">
            </div>
            <div class="col-md-8 py-5">
              <div class="mb-5 flex-center">
                <a class="fb-ic" href="https://www.facebook.com/">
                  <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                </a>

                <a class="tw-ic" href="https://twitter.com/explore">
                  <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                </a>

                <a class="yt-ic" href="https://www.youtube.com/">
                  <i class="fab fa-youtube fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                </a>

                <a class="li-ic" href="https://www.linkedin.com/">
                  <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                </a>

                <a class="ins-ic" href="https://www.instagram.com/">
                  <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                </a>

                <a class="pin-ic" href="https://www.pinterest.co.uk/">
                  <i class="fab fa-pinterest fa-lg white-text fa-2x"> </i>
                </a>
              </div>
              <div class="footer-copyright" style="color:rgb(112, 156, 142);">© 2020 Copyright: Jonny Atomic
              </div>
            </div>
          </div>
        </div>
      </footer>


      <!-- Optional JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
      <script type="javascript/text" src="animate.js"></script>
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



</body>

</html>