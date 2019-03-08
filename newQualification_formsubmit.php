<?php // Save New Qualification
  $sqlStatus = "";

  // get form fields
  $qName = $_POST['qualificationName'];
  $qMinScore = $_POST['qualificationMinScore'];
  $qMaxScore = $_POST['qualificationMaxScore'];
  $qResultCalc = $_POST['qualificationResultCalc'];
  $qSubjectCount = $_POST['subjectCount'];

  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // gen save query
  $sql = "INSERT INTO qualification (`qualificationName`, `minimumScore`, `maximumScore`, `resultCalcDescription`, `resultCalcSubjectCount`) VALUES ('$qName', '$qMinScore', '$qMaxScore', '$qResultCalc', '$qSubjectCount')";

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
    $url = 'gradeList.php';
  }
  else {
    $url = 'newQualification.php';
  }
  header('Location: ' . $url);
  die();
?>
