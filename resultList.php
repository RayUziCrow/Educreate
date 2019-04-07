<?php //Load Qualification Data
$sqlStatus = "";

session_start();

if(isset($_SESSION['selectedQ'])) { // chk if submitted
  $qID = $_SESSION['selectedQ'];
  unset($_SESSION['selectedQ']);
  if(isset($_SESSION['formSubmit'])) {
    $sqlStatus = $_SESSION['sqlStatus'];
    unset($_SESSION['sqlStatus']);
    unset($_SESSION['formSubmit']);
  }
} else {
  $qID = $_POST['selectedQ'];
}

$username = $_SESSION['username'];
$name = $_SESSION['name'];


// init db
$conn = new mysqli('localhost', 'root', '', 'educreate');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM subject"; // gen load Subjects query

// execute query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data to var
  $foundSubjects = [];
  while($row = $result->fetch_assoc()) {
    $foundSubjects[] = $row;
  }
} else {
  $foundSubjects = "";
}

$sql = "SELECT * FROM obtQualification WHERE Username = '$username' LIMIT 1"; // gen chkObtQ query

$result = $conn->query($sql); // execute query
if ($result->num_rows > 0) { // obtainedQ found
  $hasObtQ = "yes";
}
else { // obtainedQ not found
  $hasObtQ = "no";
}

// $sql = "SELECT result.subjectID, subjectName, score FROM result, subject WHERE obtainedQualificationID = '$obtQ'"; // gen load Results query
//
// // execute query
// $result = $conn->query($sql);
//
// if ($result->num_rows > 0) {
//   // output data to var
//   $foundResults = [];
//   while($result->fetch_assoc()) {
//     $foundResults[] = $row;
//   }
// } else {
//   $foundResults = "";
// }

$conn->close(); // close db
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educreate: Subject List</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <!-- animation css -->
  <link rel="stylesheet" href="plugins/animate/animate.css">
  <!-- aos -->
  <link rel="stylesheet" href="plugins/aos/aos.css">
  <!-- venobox popup -->
  <link rel="stylesheet" href="plugins/venobox/venobox.css">

  <!-- Main Stylesheet -->
  <link href="css/style.css" rel="stylesheet">

  <!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

  <!--EX Styles-->
  <style>
  .noresize {
    resize: none;
  }
  </style>

</head>

<body>


  <!-- header -->
  <header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-lg-4 text-center text-lg-left">

            <ul class="list-inline d-inline">
              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#"><?php echo $username ?></a></li>
              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#"><?php echo $name ?></a></li>
            </ul>
          </div>
          <div class="col-lg-8 text-center text-lg-right">
            <ul class="list-inline">

              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="logout.php">Logout</a></li>

            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- navbar -->
    <div class="navigation w-100">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
          <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"></a>
          <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item">
              <a class="nav-link" href="obtainedQualification.php" id="manageObtQLink">PENGUIN_ERROR</a>
            </li>
            <li class="nav-item @@about">
              <a class="nav-link" href="about.html">About</a>
            </li>
            <li class="nav-item @@courses">
              <a class="nav-link" href="courses.html">COURSES</a>
            </li>
            <li class="nav-item @@events">
              <a class="nav-link" href="events.html">EVENTS</a>
            </li>
          </ul>
      </div>
    </nav>
  </div>
</div>
</header>
<!-- /header -->
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content rounded-0 border-0 p-4">
      <div class="modal-header border-0">
        <h3>Register</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="login">
          <form action="#" class="row">
            <div class="col-12">
              <input type="text" class="form-control mb-3" id="signupPhone" name="signupPhone" placeholder="Phone">
            </div>
            <div class="col-12">
              <input type="text" class="form-control mb-3" id="signupName" name="signupName" placeholder="Name">
            </div>
            <div class="col-12">
              <input type="email" class="form-control mb-3" id="signupEmail" name="signupEmail" placeholder="Email">
            </div>
            <div class="col-12">
              <input type="password" class="form-control mb-3" id="signupPassword" name="signupPassword" placeholder="Password">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">SIGN UP</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content rounded-0 border-0 p-4">
      <div class="modal-header border-0">
        <h3>Login</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" class="row">
          <div class="col-12">
            <input type="text" class="form-control mb-3" id="loginPhone" name="loginPhone" placeholder="Phone">
          </div>
          <div class="col-12">
            <input type="text" class="form-control mb-3" id="loginName" name="loginName" placeholder="Name">
          </div>
          <div class="col-12">
            <input type="password" class="form-control mb-3" id="loginPassword" name="loginPassword" placeholder="Password">
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">LOGIN</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><span class="h2 text-primary font-secondary">Subject List</span></li>
          <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
        </ul>
        <p class="text-lighten">Add Results to your qualification by entering the details below.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- Subject Form -->
<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="section-title">Subject List<span id="subjectTitle"></span></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 mb-4 mb-lg-0">
        <p class="h2">Qualification Info</p>
        <p>Name: <span id="qualificationName">N/A</span><br/>
          Minimum Score: <span id="qualificationMinScore">N/A</span><br/>
          Maximum Score: <span id="qualificationMaxScore">N/A</span><br/>
          Score Calculation: <span id="qualificationResultCalc">N/A</span><br/>
          Number of Subjects Calculated: <span id="subjectCount">N/A</span></p>
        </div>
        <div class="col-lg-7">
          <div class="row">
            <div class="col-lg-6 mb-3">
              <p class="h2">Add Result</p>
              <div id="resultAddForm">
                <p>Subject Name: <select class="form-control mb-3" id="subjectNameSelect"></select></p>
                <p>Score: <input required type="number" min="0" max="100" class="form-control mb-3" id="resultScore" placeholder="eg: 100, 90.5, 43"></p>
                <p id="formStatus"><?php echo $sqlStatus ?></p>
                <div>
                  <button id="btn_addResult" onclick="addResult()" class="btn btn-primary">ADD</button>
                  <button id="btn_resetForm" onclick="resetResultForm()" class="btn btn-primary">RESET</button>
                </div>
              </div>
            </div>
            <div class="col-lg-6 mb-3">
              <p class="h2">Results:</p>
              <div>
                <p></p>
                <!--added Subjects go here-->
                <select id="insertedResults" class="w-100 mb-3" multiple size="10">
                </select>
              </div>
              <div>
                <button id="btn_submitSubjects" onclick="submitSubjects()" class="btn btn-primary">FINISH</button>
                <button id="btn_removeResult" onclick="removeResult()" class="btn btn-primary">REMOVE</button>
              </div>
              <div>
                <form id="resultListForm" action="resultList_formsubmit.php" method="post">
                  <input type="hidden" id="qualificationID" name="qualificationID" value="<?php echo $qID ?>">
                  <input type="hidden" id="resultList" name="resultList">
                  <input type="hidden" id="username" name="username" value="<?php echo $username ?>">
                  <input type="hidden" name="hasObtQ" value="<?php echo $hasObtQ ?>">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- /contact -->

  <!-- footer -->
  <footer>

    <!-- footer content -->
    <div class="footer bg-footer section border-bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-8 mb-5 mb-lg-0">
            <!-- logo -->
            <a class="logo-footer" href="index.php"><img class="img-fluid mb-4" src="images/logo.png" alt="logo"></a>
            <ul class="list-unstyled">
              <li class="mb-2">No. 15, Jalan Sri Semantan 1, Off Jalan Semantan, Bukit Damansara 50490 Kuala Lumpur</li>
              <li class="mb-2">Ridge Hon Fay (B1600595) <a href="mailto:rayuzicrow@gmail.com">rayuzicrow@gmail.com</a></li>
              <li class="mb-2">Muhamad Muqriz (B1800732) <a href="mailto:muqrizx@gmail.com">muqrizx@gmail.com<a/></li>
              </ul>
            </div>

          </div>
        </div>
      </div>
      <!-- copyright -->
      <div class="copyright py-4 bg-footer">
        <div class="container">
          <div class="row">
            <div class="col-sm-7 text-sm-left text-center">
              <p class="mb-0">Copyright
                <script>
                var CurrentYear = new Date().getFullYear()
                document.write(CurrentYear)
                </script>
                © Theme By <a href="https://themefisher.com">themefisher.com</a></p> . All Rights Reserved.
              </div>
              <div class="col-sm-5 text-sm-right text-center">
                <ul class="list-inline">
                  <li class="list-inline-item"><a class="d-inline-block p-2" href="https://www.facebook.com/themefisher"><i class="ti-facebook text-primary"></i></a></li>
                  <li class="list-inline-item"><a class="d-inline-block p-2" href="https://www.twitter.com/themefisher"><i class="ti-twitter-alt text-primary"></i></a></li>
                  <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-instagram text-primary"></i></a></li>
                  <li class="list-inline-item"><a class="d-inline-block p-2" href="https://dribbble.com/themefisher"><i class="ti-dribbble text-primary"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- /footer -->

      <!-- jQuery -->
      <script src="plugins/jQuery/jquery.min.js"></script>
      <!-- Bootstrap JS -->
      <script src="plugins/bootstrap/bootstrap.min.js"></script>
      <!-- slick slider -->
      <script src="plugins/slick/slick.min.js"></script>
      <!-- aos -->
      <script src="plugins/aos/aos.js"></script>
      <!-- venobox popup -->
      <script src="plugins/venobox/venobox.min.js"></script>
      <!-- mixitup filter -->
      <script src="plugins/mixitup/mixitup.min.js"></script>


      <!-- Main Script -->
      <script src="js/script.js"></script>

      <!-- EX Script -->
      <script>
      var hasObtQ = "<?php echo $hasObtQ ?>"; // get php value
      var manageObtQLink = document.getElementById("manageObtQLink");

      if (hasObtQ == "yes") {
        manageObtQLink.innerHTML = "Preview Your Qualification";
      } else {
        manageObtQLink.innerHTML = "Set Up Obtained Qualifications";
      }

      var foundSubjects = <?php echo json_encode($foundSubjects) ?>;
      var qID = <?php echo $qID ?>;

      window.onload = loadObtQualification();

      function loadObtQualification() {
         // send php_array to js
        // var qTitle = document.getElementById("qualificationTitle");
        // var qName = document.getElementById("qualificationName");
        // var rMinScore = document.getElementById("qualificationMinScore");
        // var rMaxScore = document.getElementById("qualificationMaxScore");
        // var qResultCalc = document.getElementById("qualificationResultCalc");
        // var qSubjectCount = document.getElementById("subjectCount");
        // var resultList = document.getElementById("resultList");

        // fill Qualification Info
        // qTitle.innerHTML = ": " + foundQ.qualificationName;
        // qName.innerHTML = foundQ.qualificationName;
        // rMinScore.innerHTML = foundQ.minimumScore;
        // rMaxScore.innerHTML = foundQ.maximumScore;

        // get resultCalcDescription
        // var resultCalcDescVal = foundQ.resultCalcDescription;
        // var resultCalcDescText;
        // switch (resultCalcDescVal) {
        //   case "avg_highest":
        //     resultCalcDescText = "Average of Highest Scores";
        //     break;
        //   case "avg_lowest":
        //     resultCalcDescText = "Average of Lowest Scores";
        //     break;
        //   case "sum_highest":
        //     resultCalcDescText = "Sum of Highest Scores";
        //     break;
        //   case "sum_lowest":
        //     resultCalcDescText = "Sum of Lowest Scores";
        //     break;
        // }
        // qResultCalc.innerHTML = resultCalcDescText;
        // qSubjectCount.innerHTML = foundQ.resultCalcSubjectCount;
        var formStatus = document.getElementById("formStatus");

        // fill Subjects select
        var subjectNameSelect = document.getElementById("subjectNameSelect");
        for(var i = 0; i < foundSubjects.length; i++) {
          var newSubject = document.createElement("option");
          var newSubjectText = document.createTextNode(foundSubjects[i].subjectName);
          newSubject.appendChild(newSubjectText);
          newSubject.value = foundSubjects[i].subjectID + ":" + foundSubjects[i].subjectName;
          subjectNameSelect.appendChild(newSubject);
        }

        // fill existing Results
      //   var insertedResults = document.getElementById("insertedResults");
      //   for(var i = 0; i < foundResults.length; i++) {
      //     // create Result
      //     var newResult = document.createElement("option");
      //     var newResultText = document.createTextNode(foundResults[i].subjectName + ": " + foundResults[i].score);
      //     newResult.appendChild(newResultText);
      //     newResult.value = foundResults[i].subjectID + ":" + foundResults[i].subjectName + ":" + foundResults[i].score;
      //     // insert Result
      //     insertedResults.appendChild(newResult);
      //   }
      }

      function addResult() {
        // get resultForm values
        var selectedS = document.getElementById("subjectNameSelect").value;
        var parsedS = selectedS.split(":");
        var rScore = document.getElementById("resultScore").value;

        // chk for fill
        var formStatus = document.getElementById("formStatus");
        var formValid = chkResultValid(parsedS[0], rScore);
        if(formValid == "valid") {
          // get insertedResults list
          var insertedResults = document.getElementById("insertedResults");
          // create Subject
          var newResult = document.createElement("option");
          var newResultText = document.createTextNode(parsedS[1] + ": " + rScore);
          newResult.appendChild(newResultText);
          newResult.value = parsedS[0] + ":" + rScore;
          // insert Subject
          insertedResults.appendChild(newResult);
          // sort resultList

          // reset resultForm
          // resetResultForm();
          formStatus.innerHTML = "";
        }
        else if(formValid == "symbol_error") {
          formStatus.innerHTML = "ERROR: Subject Name cannot contain ',' or ':'";
        }
        else if(formValid == "duplicate") {
          formStatus.innerHTML = "ERROR: Subject already exists";
        }
        else if(formValid == "out_of_range") {
          var rMinScore = document.getElementById("qualificationMinScore").innerHTML;
          var rMaxScore = document.getElementById("qualificationMaxScore").innerHTML;
          formStatus.innerHTML = "ERROR: Score must be in range of Minimum (" + rMinScore + ") & Maximum (" + rMaxScore + ") Scores";
        }
        else {
          formStatus.innerHTML = "ERROR: Please enter valid values for Subject Name & Score";
        }
      }

      function chkResultValid(rName, rScore) {
        var rMinScore = 0;
        var rMaxScore = 100;

        if(rName == null || rName == "" || rScore == null || rScore == "") { // chk if subject is valid
          return "invalid";
        }

        if(!(rScore >= rMinScore && rScore <= rMaxScore)) { // chk if in range
          return "out_of_range";
        }
        var insertedResults = document.getElementById("insertedResults");
        if(insertedResults.children.length > 0) {
          for(var i = 0; i < insertedResults.children.length; i++) { // chk if subject exists
            var existingResult = insertedResults.children[i].value;
            var existingSubjectID = existingResult.substring(0, existingResult.indexOf(':'));
            if(rName == existingSubjectID) {
              return "duplicate";
            }
          }
        }

        return "valid";
      }

      function resetResultForm() {
        // get resultForm values
        var sNameSelect = document.getElementById("subjectNameSelect");
        var rScore = document.getElementById("resultScore");
        // reset to blank
        sNameSelect.value = "";
        rScore.value = "";
      }

      function removeResult() {
        var insertedResults = document.getElementById("insertedResults");
        for(var i = 0; i < insertedResults.children.length; i++) { // get index of selected Subjects
          if(insertedResults.children[i].selected) {
            insertedResults.remove(i); // remove by index
          }
        }
      }

      function submitSubjects() {
        // get Subjects
        var insertedResults = document.getElementById("insertedResults");
        var subjects = new Array();

        // var subjectNames = new array();
        // var resultScores = new array();
        for(var i = 0; i < insertedResults.children.length; i++) { // extract resultList
          var subject = insertedResults.children[i].value;
          subjects.push(subject);
          // subjectNames.push(subject.substring(0, existingSubject.indexOf(':')));
          // resultScores.push(parseInt(subject.substring(existingSubject.indexOf(':') + 1)));
        }

        // get form
        var resultListForm = document.getElementById("resultListForm");
        var obtQID = document.getElementById("qualificationID");
        var resultList = document.getElementById("resultList");
        var username = document.getElementById("username");
        // send resultList to hidden form input
        obtQID.value = qID;
        resultList.value = subjects;

        if(resultList.value.length != 0) { // chk if valid
          resultListForm.submit();
        }
        else {
          var formStatus = document.getElementById("formStatus");
          // prompt to exit
          alert("ERROR: No Results in list");
        }
      }

      // function testSubjects() {
      //   // get Subjects
      //   var insertedResults = document.getElementById("insertedResults");

      //   var obtQID = foundQ.qualificationID; // get QualificationID to save
      //   var subjects = new Array();
      //   // var subjectNames = new array();
      //   // var resultScores = new array();
      //   for(var i = 0; i < insertedResults.children.length; i++) { // extract resultList
      //     var subject = insertedResults.children[i].value;
      //     subjects.push(subject);
      //     // subjectNames.push(subject.substring(0, existingSubject.indexOf(':')));
      //     // resultScores.push(parseInt(subject.substring(existingSubject.indexOf(':') + 1)));
      //   }

      //   // get form
      //   var resultListForm = document.getElementById("resultListForm");
      //   var obtQID = document.getElementById("qualificationID");
      //   var resultList = document.getElementById("qualificationSubjects");
      //   // send resultList to hidden form input
      //   obtQID.value = foundQ.qualificationID;
      //   resultList.value = subjects;

      //   var formStatus = document.getElementById("formStatus");
      //   formStatus.innerHTML = resultList.value;
      // }
      </script>

    </body>
    </html>
