<?php // Save New University
  $sqlStatus = "";

  // get form fields
  $uName = $_POST['uniName'];
  $uAdmin = $_POST['uniAdmin'];

  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // gen save query
  $sql = "INSERT INTO university (`universityName`, `universityAdmin`) VALUES ('$uName', (SELECT `username` FROM user WHERE `username` = '$uAdmin'))";

  // execute query
  if ($conn->query($sql) === TRUE) {
      $sqlStatus = "New University registered successfully";
  } else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close(); // close db

  session_start();
  $_SESSION['formSubmit'] = 'sent'; // notify form is sent
  $_SESSION['sqlStatus'] = $sqlStatus; // store msg

  // redirect to form
  $url = 'registerUni.php';
  header('Location: ' . $url);
  die();
?>
