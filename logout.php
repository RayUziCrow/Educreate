<?php
session_start();
unset($_SESSION["Username"]);
unset($_SESSION["Name"]);
header("Location:index.php");
 ?>
