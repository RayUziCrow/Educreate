<?php
session_start(); // init store session var

$loginStatus = "";

// get form fields
$username = $_POST['Username'];
$password = $_POST['Password'];
$name = "NO_NAME";
$uniID = "NO_UNI";

// var_dump($username);
// var_dump($password);

// init db
$conn = new mysqli('localhost', 'root', '', 'educreate');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// process form fields
$decodedPassword = md5($password);
// var_dump($decodedPassword);

$loginStatus = "fail";
$url = 'index.php';

$isApplicant = chkApplicant();
if($isApplicant == true) {
  $_SESSION['username'] = $username;
  $_SESSION['name'] = $name;
  // Redirect user to apphome.php
  $url = 'apphome.php';
  $loginStatus = "pass";
} else {
  $isUniAdmin = chkUniAdmin();
  if($isUniAdmin == true) {
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $name;
    $_SESSION['uniID'] = $uniID;
    // Redirect user to unihome.php
    $url = 'unihome.php';
    $loginStatus = "pass";
  }
}

$conn->close(); // close db
$_SESSION['loginStatus'] = $loginStatus;
header('Location: ' . $url);
die();

function chkApplicant() { // chk for Applicant
  // get vars
  global $conn, $username, $decodedPassword, $name;

  // gen load query
  $sql = "SELECT * FROM user,applicant WHERE user.Username='$username'
  and Password='$decodedPassword' and applicant.Username = '$username' LIMIT 1";

  // execute query
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $foundApplicant = $result->fetch_assoc();
    $name = $foundApplicant['Name'];
    return true; // found
  } else {
    return false; // not found
  }
}

function chkUniAdmin() { // chk for UniAdmin
  // get vars
  global $conn, $username, $decodedPassword, $name, $uniID;

  // gen load query
  $sql = "SELECT * FROM user,university WHERE user.Username='$username'
  and Password='$decodedPassword' and university.UniversityAdmin = '$username' LIMIT 1";

  // execute query
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $foundUniAdmin = $result->fetch_assoc();
    $name = $foundUniAdmin['Name'];
    $uniID = $foundUniAdmin['UniversityID'];
    return true; // found
  } else {
    return false; // not found
  }
}
?>
