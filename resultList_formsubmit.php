<?php // Save New Qualification
$sqlStatus = "";

// get form fields
$qID = $_POST['qualificationID'];
$resultList = $_POST['resultList'];
$username = $_POST['username'];
$oldObtQ = $_POST['oldObtQ'];
$obtQID = -1;

if(empty($resultList)) {
  $url = 'apphome.php';
  header('Location: ' . $url);
  die();
}
else {
  processGrades();
}

function processGrades() {
  global $qID, $resultList, $username, $oldObtQ, $obtQID;
  // split Grades
  $results = explode(',', $resultList);

  // split Names & Upper Limits
  $rIDs = [];
  $rScores = [];
  for($i = 0; $i < sizeof($results); $i++) {
    $splitPos = strpos($results[$i], ':');
    $rIDs[] = substr($results[$i], 0, $splitPos);
    $rScores[] = substr($results[$i], $splitPos + 1);
  }

  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  session_start(); // init store session var

  $_SESSION['formSubmit'] = 'success';

  if ($oldObtQ != -1) { // have old obtQ - update
    $obtQID = $oldObtQ;

    $sql = "UPDATE obtQualification SET qualificationID = '$qID' WHERE username = '$username' AND obtQualificationID = '$obtQID'"; //update old obtQ

    if ($conn->query($sql) === TRUE) {

    }
    else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
      $_SESSION['formSubmit'] = 'fail';
      $selectedQ = $qID;
      $_SESSION['selectedQ'] = $selectedQ;
    }

    $sql = "DELETE FROM result WHERE obtainedQualificationID = '$obtQID'"; // delete old Results

    if ($conn->query($sql) === TRUE) {

    }
    else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
      $_SESSION['formSubmit'] = 'fail';
      $selectedQ = $qID;
      $_SESSION['selectedQ'] = $selectedQ;
    }

  } else { // new obtQ
    $sql = "INSERT INTO obtQualification (`qualificationID`, `username`) VALUES ('$qID', '$username')"; // save obtQ

    // execute save query
    if ($conn->query($sql) === TRUE) {

    } else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
      $_SESSION['formSubmit'] = 'fail';
      $selectedQ = $qID;
      $_SESSION['selectedQ'] = $selectedQ;
    }
  }

  $sql = "SELECT * FROM obtQualification WHERE Username = '$username' LIMIT 1"; // get new obtQID

  $result = $conn->query($sql); // execute query
  if ($result->num_rows > 0) { // obtainedQ found
    $obtQ = $result->fetch_assoc();
    $obtQID = $obtQ['obtQualificationID'];

    $sql = "INSERT INTO result (`subjectID`, `obtainedQualificationID`, `score`) VALUES "; // save Results
    for($i = 0; $i < sizeof($results); $i++) {
      if($i == sizeof($results) - 1) {
        $sql = $sql . "('$rIDs[$i]', '$obtQID', '$rScores[$i]')";
      }
      else {
        $sql = $sql . "('$rIDs[$i]', '$obtQID', '$rScores[$i]'), ";
      }
    }

    // execute save query
    if ($conn->query($sql) === TRUE) {

    } else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
      $_SESSION['formSubmit'] = 'fail';
      $selectedQ = $qID;
      $_SESSION['selectedQ'] = $selectedQ;
    }
  }
  else { // obtainedQ not found
    $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
    $_SESSION['formSubmit'] = 'fail';
    $selectedQ = $qID;
    $_SESSION['selectedQ'] = $selectedQ;
  }

$conn->close(); // close db
}

$_SESSION['sqlStatus'] = $sqlStatus; // store msg

if($_SESSION['formSubmit'] == 'success') {
  $sqlStatus = "Obtained Qualification saved successfully";

  // redirect to form
  $url = 'apphome.php';
}
else {
  $url = 'resultList.php';
}
header('Location: ' . $url);
die();
?>
