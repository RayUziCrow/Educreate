<<<<<<< HEAD
<?php
  $sqlStatus = "";

  // get form fields
  $applicant = $_POST['applicant'];
  $progID = $_POST['programmeID'];
  $currentDate = $_POST['currentDate'];

  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // gen save query
  $sql = "INSERT INTO application VALUES ('$applicant', '$progID', '$currentDate', 'Pending')";

  session_start(); // init store session var
  // execute query
  if ($conn->query($sql) === TRUE) {
      $sqlStatus = "Application successful";
      $_SESSION['formSubmit'] = 'success';
  } else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
      $_SESSION['formSubmit'] = 'fail';
  }

  $conn->close(); // close db

  $_SESSION['sqlStatus'] = $sqlStatus; // store msg

  if($_SESSION['formSubmit'] == 'success') {
    // redirect to form
    $url = 'apphome.php';
  }
  else {
    $url = 'apphome.php';
  }
  header('Location: ' . $url);
  die();
?>
=======
<?php
  $sqlStatus = "";

  // get form fields
  $applicant = $_POST['applicant'];
  $progID = $_POST['programmeID'];
  $currentDate = $_POST['currentDate'];

  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // gen save query
  $sql = "INSERT INTO application VALUES ('$applicant', '$progID', '$currentDate', 'Pending')";

  session_start(); // init store session var
  // execute query
  if ($conn->query($sql) === TRUE) {
      $sqlStatus = "Application successful";
      $_SESSION['formSubmit'] = 'success';
  } else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
      $_SESSION['formSubmit'] = 'fail';
  }

  $conn->close(); // close db

  $_SESSION['sqlStatus'] = $sqlStatus; // store msg

  if($_SESSION['formSubmit'] == 'success') {
    // redirect to form
    $url = 'apphome.php';
  }
  else {
    $url = 'apphome.php';
  }
  header('Location: ' . $url);
  die();
?>
>>>>>>> da5dad0ae36053049388d7bd990089c9e04e79de
