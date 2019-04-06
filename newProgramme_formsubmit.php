<?php // Save New Programme
  $sqlStatus = "";

  // get form fields
  $uID = $_POST['universityID'];
  $pName = $_POST['programmeName'];
  $pDesc = $_POST['programmeDesc'];
  $pEntryScore = $_POST['programmeEntryScore'];
  $pClosingDate = $_POST['programmeClosingDate'];

  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // gen save query
  $sql = "INSERT INTO programme (`universityID`, `name`, `description`, `entryScore`, `closingDate`) VALUES ('$uID', '$pName', '$pDesc', '$pEntryScore', '$pClosingDate')";

  session_start(); // init store session var
  // execute query
  if ($conn->query($sql) === TRUE) {
      $sqlStatus = "New Programme created successfully";
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
    $url = 'newProgramme.php';
  }
  else {
    $url = 'newProgramme.php';
  }
  header('Location: ' . $url);
  die();
?>
