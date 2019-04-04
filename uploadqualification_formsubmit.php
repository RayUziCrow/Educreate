<?php 
  // get form fields
  include("auth.php");
  $obtQ = $_POST['obtainedQ'];
  $username = $_SESSION['username'];
  


  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // gen save query
  $sql = "INSERT INTO obtQualification (`qualificationID`, `username`) VALUES ('$obtQ', '$username')";

  session_start(); // init store session var
  // execute query
  if ($conn->query($sql) === TRUE) {
      $sqlStatus = "New Qualification created successfully";
      $_SESSION['formSubmit'] = 'success';
      $createdQ = $conn->insert_id;
      $_SESSION['selectedQ'] = $createdQ;
  } else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
      $_SESSION['formSubmit'] = 'fail';
  }

  $conn->close(); // close db

  $_SESSION['sqlStatus'] = $sqlStatus; // store msg

  if($_SESSION['formSubmit'] == 'success') {
    // redirect to form
    $url = 'subjectList.php';
  }
  else {
    $url = 'uploadqualification.php';
  }
  header('Location: ' . $url);
  die();
?>
