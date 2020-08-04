<?php
include("conn.php");

$ntdatx = $_POST['ntxaxis'];
$ntdaty = $_POST['ntyaxis'];
$ntdatz = $_POST['ntzaxis'];
$dire = $_POST['direct'];
$can = $_POST['canvas'];

 print_r($_POST);

 $mydate = date("d-m-Y");
 
	$insert = "INSERT INTO TensorData (Date, Xaxis, Yaxis, Zaxis, Direction, Image)
        VALUES ('$mydate','$ntdatx','$ntdaty','$ntdatz','$dire', '$can');";

	if ($conn->query($insert) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $insert . "<br>" . $conn->error;
	}

?>