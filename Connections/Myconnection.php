<?php

//Declaring connection to the localhost server
$con = mysqli_connect("localhost","root","","educreate");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
