<?php


$user = "upqapbgp59wgz";
$pw = "GingerCandle99";
$server = "localhost";
$db = "dbmqaavphg245w";

$conn = new mysqli($server, $user, $pw, $db);


if($conn->connect_error){
    echo $conn->connect_error;
}
