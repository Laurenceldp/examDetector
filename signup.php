<?php
include("conn.php");
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

    <title>Face Detection</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>


    <div class="jumbotron jumbotron-fluid text-center" style="background-color:rgb(6, 50, 56)">

        <h1 style="font-size:8vw" class="text-white " style="background-color:rgb(6, 50, 56)">SIGN UP</h1><br>
    </div>
    <!-- Sign up form takes values from the form, checking for sql injection issues and verifying password confirmation. 
  Password hashed and entered into database with default PHP hash method to ensure any updates are included in furture php releases-->
    <?php

    if (isset($_POST['submit'])) {

        $tdate = date('Y-m-d');

        $firstname =   $conn->real_escape_string(trim($_POST['firstname']));
        $lastname = $conn->real_escape_string(trim($_POST['lastname']));
        $email = $conn->real_escape_string(trim($_POST['email']));
        $passwordpre = $conn->real_escape_string(trim($_POST['password']));
        $passwordp = $conn->real_escape_string(trim($_POST['pconfirm']));
        if ($passwordpre == $passwordp) {
            $hashedpass = password_hash($passwordpre, PASSWORD_DEFAULT);
        } else {
            echo "passwords don't match - try again";
        }
        $gdprstate = $_POST['gdpr'] = 1;

        $insert = "INSERT INTO User (UserID, FirstName, LastName, Email, Password, GDPR, DateJoined)
VALUES ('','$firstname', '$lastname','$email', '$hashedpass','$gdprstate', '$tdate');";
if ($conn->query($insert) === TRUE) {
    header("location: https://laurencefay.com/examdetector/login.php");
    ob_end_flush();
      } else {
    echo "Error: " . $insert . "<br>" . $conn->error;
  }
}
    ?>
    <div class="container">

        <form action="signup.php" method="POST">

            <div class="row">
                <div class="col-lg-4">
                    <input type="text" class="form-control form-group" placeholder="First name" name="firstname" required>
                </div>
                <div class="col-lg-4">
                    <input type="text" class="form-control form-group" placeholder="Last name" name="lastname" required>
                </div>

                <div class="col-lg-4">
                    <input type="email" class="form-control form-group" placeholder="Email" name="email" required>

                    </div>
                <div class="col-lg-4">
                    <input type="password" class="form-control form-group" placeholder="Password" name="password" required>
                </div>
                <div class="col-lg-4">
                    <input type="password" class="form-control form-group" placeholder="Confirm password" name="pconfirm" required>
                </div> 

                </div>
            </div>
            <div class="container">

                <div class="col-lg-12">
                    <p> LaurenceFay.com GDPR and Data Protection Policy</p>
                    <p>This website will record and store your name and email address securely. It will not be shared with third parties. This information is only used as a reference for
                        data recording. A still frame of your image will be recorded from your webcam video feed. These images will be stored securely for the duration of this research project.
                        Once the project has been submitted and marked by Queen's University Belfast, all data will be deleted (approx winter 2020). You must be over 16 to participate in this research trial.
                    </p>

                    <div class="col-lg-12">
                        <input type="checkbox" class="form-check-input" id="gdprstate" name='gdpr' required>
                        <small id="gdpr" class="form-text text-muted">Please confirm you consent to your names, email and images provided by webcam being stored and used for the duration of the project.</small>
                    </div>
                    <button type="submit" href="https://laurencefay.com/examdetector/login.php" name="submit" class="btn btn-secondary btn-lg btn-block">Sign up</button>
                </div>
        </form>



        </footer>


</body>

</html>