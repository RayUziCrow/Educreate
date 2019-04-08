<?php
  $sqlStatus = "";

  // get form fields
  $applicant = $_POST['rApplicant'];
  $progID = $_POST['rProgID'];
  $newStatus = $_POST['newStatus'];

  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // gen save query
  $sql = "UPDATE application SET status = '$newStatus' WHERE applicant = '$applicant' AND programmeID = '$progID'";

  session_start(); // init store session var
  // execute query
  if ($conn->query($sql) === TRUE) {
      $sqlStatus = "Application reviewed successfully";
      $_SESSION['formSubmit'] = 'success';
  } else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
      $_SESSION['formSubmit'] = 'fail';
  }

  $conn->close(); // close db

  $_SESSION['sqlStatus'] = $sqlStatus; // store msg

  if($_SESSION['formSubmit'] == 'success') {
    // redirect to form
    $url = 'unihome.php';
  }
  else {
    $url = 'unihome.php';
  }
  header('Location: ' . $url);
  die();
?>
