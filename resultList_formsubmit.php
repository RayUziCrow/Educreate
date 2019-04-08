<?php // Save New Qualification
  $sqlStatus = "";

  // get form fields
  $qID = $_POST['qualificationID'];
  $resultList = $_POST['resultList'];
  $username = $_POST['username'];

  if(empty($resultList)) {
    $url = 'apphome.php';
    header('Location: ' . $url);
    die();
  }
  else {
    processGrades();
  }

  function processGrades() {
    global $qID, $resultList, $username;
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

    // remove old, replace with new
    session_start(); // init store session var

    // gen delete query
    // $sql = "DELETE FROM gradelist WHERE qualificationID = '$qID'";

    // // execute delete query
    // if ($conn->query($sql) === TRUE) {
    //     $sqlStatus = "Grades deleted successfully";
    // } else {
    //     $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
    //     $_SESSION['formSubmit'] = 'fail';
    //     $selectedQ = $qID;
    //     $_SESSION['selectedQ'] = $selectedQ;
    // }
    // gen save query

    $_SESSION['formSubmit'] = 'success';

    $sql = "INSERT INTO obtQualification (`qualificationID`, `username`) VALUES ('$qID', '$username')";

    // execute save query
    if ($conn->query($sql) === TRUE) {
      

    } else {
        $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['formSubmit'] = 'fail';
        $selectedQ = $qID;
        $_SESSION['selectedQ'] = $selectedQ;
    }
  


    $sql = "SELECT * FROM obtQualification WHERE username = '$username'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {
        $obtQ = $row["obtQualificationID"];
      }
  }
        else { echo "Query error";
    }
      


    $sql = "INSERT INTO result (`subjectID`, `obtainedQualificationID`, `score`) VALUES ";
    for($i = 0; $i < sizeof($results); $i++) {
      if($i == sizeof($results) - 1) {
        $sql = $sql . "('$rIDs[$i]', '$obtQ', '$rScores[$i]')";
      }
      else {
        $sql = $sql . "('$rIDs[$i]', '$obtQ', '$rScores[$i]'), ";
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

    $conn->close(); // close db

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
}




  // function deleteOldGrades() {
  //   // gen delete query
  //   $sql = "DELETE FROM gradelist WHERE qualificationID = '$qID'";
  //
  //   // execute delete query
  //   if ($conn->query($sql) === TRUE) {
  //       $sqlStatus = "Grades deleted successfully";
  //   } else {
  //       $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
  //       $_SESSION['formSubmit'] = 'fail';
  //       $selectedQ = $qID;
  //       $_SESSION['selectedQ'] = $selectedQ;
  //   }
  // }
  //
  // function saveGrades() {
  //   // gen save query
  //   $sql = "INSERT INTO gradelist (`qualificationID`, `grade`, `scoreUpperLimit`) VALUES ";
  //   for($i = 0; $i < sizeof($results); $i++) {
  //     if($i == sizeof($results) - 1) {
  //       $sql = $sql . "('$qID[$i]', '$gNames[$i]', '$gUpperLimits[$i]')";
  //     }
  //     else {
  //       $sql = $sql . "('$qID[$i]', '$gNames[$i]', '$gUpperLimits[$i]'), ";
  //     }
  //   }
  //
  //   // execute save query
  //   if ($conn->query($sql) === TRUE) {
  //       $sqlStatus = "Grades created successfully";
  //       $_SESSION['formSubmit'] = 'success';
  //   } else {
  //       $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
  //       $_SESSION['formSubmit'] = 'fail';
  //       $selectedQ = $qID;
  //       $_SESSION['selectedQ'] = $selectedQ;
  //   }
  // }
?>
