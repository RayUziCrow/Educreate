<?php // Save New Qualification
  $sqlStatus = "";

  // get form fields
  $qID = $_POST['qualificationID'];
  $qName = $_POST['qualificationName'];
  $qMinScore = $_POST['qualificationMinScore'];
  $qMaxScore = $_POST['qualificationMaxScore'];
  $qScoreChanged = $_POST['scoreChanged'];
  $qResultCalc = $_POST['qualificationResultCalc'];
  $qSubjectCount = $_POST['subjectCount'];

  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // gen save query
  $sql = "UPDATE qualification SET qualificationName = '$qName', minimumScore = '$qMinScore', maximumScore = '$qMaxScore', resultCalcDescription = '$qResultCalc', resultCalcSubjectCount = '$qSubjectCount' WHERE qualificationID = '$qID'";

  session_start(); // init store session var
  // execute query
  if ($conn->query($sql) === TRUE) {
      $sqlStatus = "Qualification edited successfully";
      $_SESSION['formSubmit'] = 'success';
  } else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
      $_SESSION['formSubmit'] = 'fail';
  }
  $editedQ = $qID;
  $_SESSION['selectedQ'] = $editedQ;

  // chk if scoreChanged
  if($qScoreChanged == "true") {
    // clear Grades
    // gen delete query
    $sql = "DELETE FROM gradelist WHERE qualificationID = '$qID'";

    // execute delete query
    if ($conn->query($sql) === TRUE) {
        $sqlStatus = "Due to change of Minimum/Maximum Scores, existing Grades have been removed";
    } else {
        $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['formSubmit'] = 'fail';
    }
  }

  $conn->close(); // close db

  $_SESSION['sqlStatus'] = $sqlStatus; // store msg

  if($_SESSION['formSubmit'] == 'success') {
    // redirect to form
    $url = 'gradeList.php';
  }
  else {
    $url = 'editQualification_details.php';
  }
  header('Location: ' . $url);
  die();
?>
