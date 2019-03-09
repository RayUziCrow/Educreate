<?php // Load Qualification Data
$sqlStatus = "";

session_start();
$selectedQ = -1;
if(isset($_SESSION['selectedQ'])) { // chk if submitted
  $selectedQ = $_SESSION['selectedQ'];
  if(isset($_SESSION['formSubmit'])) {
    $sqlStatus = $_SESSION['sqlStatus'];
  }
  session_unset();
}

// init db
$conn = new mysqli('localhost', 'root', '', 'educreate');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// dummy data (online)
// $selectedQ = 1;

$sql = "SELECT * FROM qualification WHERE qualificationID = '$selectedQ' LIMIT 1"; // gen load q query

// execute query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data to var
  $foundQ = $result->fetch_assoc();
  // load existing Grades
  $sql = "SELECT * FROM gradelist WHERE qualificationID = '$selectedQ'"; // gen load grades query
  // execute query
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $foundGrades = [];
    while($row = $result->fetch_assoc()) {
      $foundGrades[] = $row;
    }
  }
  else {
    $foundGrades = "";
  }
} else {

}

// dummy data (offline)
// $foundQ = array("qualificationID" => 1, "qualificationName" => "DummyQ", "minimumScore" => 0, "maximumScore" => 100, "resultCalcDescription" => "avg_highest", "resultCalcSubjectCount" => 3);

$conn->close(); // close db
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educreate: Grade List</title>

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
            <span class="text-color mr-3"><strong>MASTER ADMIN</strong></span>

          </div>
          <div class="col-lg-8 text-center text-lg-right">

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
            <li class="nav-item @@home">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item @@home">
              <a class="nav-link" href="masterDashboard.php">MASTER DASHBOARD</a>
            </li>
            <li class="nav-item dropdown view active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Qualifications
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="newQualification.php">New Qualification</a>
              <a class="dropdown-item" href="editQualification.php">Edit Qualification</a>
            </div>
          </li>
          <li class="nav-item @@contact">
            <a class="nav-link" href="registerUni.php">REGISTER UNIVERSITY</a>
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
          <li class="list-inline-item"><span class="h2 text-primary font-secondary">Grade List</span></li>
          <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
        </ul>
        <p class="text-lighten">Add Grades to a Qualification by entering the details below.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- Grade Form -->
<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="section-title">Grade List<span id="qualificationTitle"></span></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 mb-4 mb-lg-0">
        <p class="h2">Qualificiation Info</p>
        <p>Name: <span id="qualificationName">N/A</span><br/>
          Minimum Score: <span id="qualificationMinScore">N/A</span><br/>
          Maximum Score: <span id="qualificationMaxScore">N/A</span><br/>
          Score Calculation: <span id="qualificationResultCalc">N/A</span><br/>
          Number of Subjects Calculated: <span id="subjectCount">N/A</span></p>
        </div>
        <div class="col-lg-7">
          <div class="row">
            <div class="col-lg-6 mb-3">
              <p class="h2">Add Grade</p>
              <div id="gradeAddForm">
                <p>Grade Name: <input required type="text" class="form-control mb-3" id="gradeName" placeholder="eg: A, A+, B"></p>
                <p>Upper Limit: <input required type="number" class="form-control mb-3" id="gradeUpperLimit" placeholder="eg: 100, 90.5, 43"></p>
                <p id="formStatus"><?php echo $sqlStatus ?></p>
                <div>
                  <button id="btn_addGrade" onclick="addGrade()" class="btn btn-primary">ADD</button>
                  <button id="btn_resetForm" onclick="resetGradeForm()" class="btn btn-primary">RESET</button>
                </div>
              </div>
            </div>
            <div class="col-lg-6 mb-3">
              <p class="h2">Grades:</p>
              <div>
                <p></p>
                <!--added Grades go here-->
                <select id="insertedGrades" class="w-100 mb-3" multiple size="10">
                </select>
              </div>
              <div>
                <button id="btn_submitGrades" onclick="submitGrades()" class="btn btn-primary">FINISH</button>
                <button id="btn_removeGrade" onclick="removeGrade()" class="btn btn-primary">REMOVE</button>
              </div>
              <div>
                <form id="gradeListForm" action="gradeList_formsubmit.php" method="post">
                  <input type="hidden" id="qualificationID" name="qualificationID">
                  <input type="hidden" id="qualificationGrades" name="qualificationGrades">
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
      var foundQ = <?php echo json_encode($foundQ) ?>;
      var foundGrades = <?php echo json_encode($foundGrades) ?>;
      window.onload = loadQualification();

      function loadQualification() {
         // send php_array to js
        var qTitle = document.getElementById("qualificationTitle");
        var qName = document.getElementById("qualificationName");
        var qMinScore = document.getElementById("qualificationMinScore");
        var qMaxScore = document.getElementById("qualificationMaxScore");
        var qResultCalc = document.getElementById("qualificationResultCalc");
        var qSubjectCount = document.getElementById("subjectCount");

        // fill Qualification Info
        qTitle.innerHTML = ": " + foundQ.qualificationName;
        qName.innerHTML = foundQ.qualificationName;
        qMinScore.innerHTML = foundQ.minimumScore;
        qMaxScore.innerHTML = foundQ.maximumScore;
        // get resultCalcDescription
        var resultCalcDescVal = foundQ.resultCalcDescription;
        var resultCalcDescText;
        switch (resultCalcDescVal) {
          case "avg_highest":
            resultCalcDescText = "Average of Highest Scores";
            break;
          case "avg_lowest":
            resultCalcDescText = "Average of Lowest Scores";
            break;
          case "sum_highest":
            resultCalcDescText = "Sum of Highest Scores";
            break;
          case "sum_lowest":
            resultCalcDescText = "Sum of Lowest Scores";
            break;
        }
        qResultCalc.innerHTML = resultCalcDescText;
        qSubjectCount.innerHTML = foundQ.resultCalcSubjectCount;
        var formStatus = document.getElementById("formStatus");

        // fill existing Grades
        var insertedGrades = document.getElementById("insertedGrades");
        for(var i = 0; i < foundGrades.length; i++) {
          // create Grade
          var newGrade = document.createElement("option");
          var newGradeText = document.createTextNode(foundGrades[i].grade + ": " + foundGrades[i].scoreUpperLimit);
          newGrade.appendChild(newGradeText);
          newGrade.value = foundGrades[i].grade + ":" + foundGrades[i].scoreUpperLimit;
          // insert Grade
          insertedGrades.appendChild(newGrade);
        }
      }

      function addGrade() {
        // get gradeForm values
        var gName = document.getElementById("gradeName").value;
        var gUpperLimit = document.getElementById("gradeUpperLimit").value;

        // chk for fill
        var formStatus = document.getElementById("formStatus");
        var formValid = chkGradeValid(gName, gUpperLimit);
        if(formValid == "valid") {
          // get insertedGrades list
          var insertedGrades = document.getElementById("insertedGrades");
          // create Grade
          var newGrade = document.createElement("option");
          var newGradeText = document.createTextNode(gName + ": " + gUpperLimit);
          newGrade.appendChild(newGradeText);
          newGrade.value = gName + ":" + gUpperLimit;
          // insert Grade
          insertedGrades.appendChild(newGrade);
          // sort gradeList

          // reset gradeForm
          resetGradeForm();
          formStatus.innerHTML = "";
        }
        else if(formValid == "symbol_error") {
          formStatus.innerHTML = "ERROR: Grade Name cannot contain ',' or ':'";
        }
        else if(formValid == "duplicate") {
          formStatus.innerHTML = "ERROR: Grade already exists";
        }
        else if(formValid == "out_of_range") {
          var qMinScore = document.getElementById("qualificationMinScore").innerHTML;
          var qMaxScore = document.getElementById("qualificationMaxScore").innerHTML;
          formStatus.innerHTML = "ERROR: Upper Limit must be in range of Minimum (" + qMinScore + ") & Maximum (" + qMaxScore + ") Scores";
        }
        else {
          formStatus.innerHTML = "ERROR: Please enter valid values for Grade Name & Upper Limit";
        }
      }

      function chkGradeValid(gName, gUpperLimit) {
        // get qualification score info
        var qMinScore = parseInt(document.getElementById("qualificationMinScore").innerHTML);
        var qMaxScore = parseInt(document.getElementById("qualificationMaxScore").innerHTML);


        if(gName == null || gName == "" || gUpperLimit == null || gUpperLimit == "") { // chk if grade is valid
          return "invalid";
        }
        if(gName.indexOf(":") > -1 || gName.indexOf(",") > -1) {
          return "symbol_error";
        }
        if(!(gUpperLimit >= qMinScore && gUpperLimit <= qMaxScore)) { // chk if in range
          return "out_of_range";
        }
        var insertedGrades = document.getElementById("insertedGrades");
        if(insertedGrades.children.length > 0) {
          for(var i = 0; i < insertedGrades.children.length; i++) { // chk if grade exists
            var existingGrade = insertedGrades.children[i].value;
            var existingGradeName = existingGrade.substring(0, existingGrade.indexOf(':'));
            var existingGradeUpperLimit = existingGrade.substring(existingGrade.indexOf(':') + 1);
            if(gName == existingGradeName || gUpperLimit == existingGradeUpperLimit) {
              return "duplicate";
            }
          }
        }

        return "valid";
      }

      function resetGradeForm() {
        // get gradeForm values
        var gName = document.getElementById("gradeName");
        var gUpperLimit = document.getElementById("gradeUpperLimit");
        // reset to blank
        gName.value = "";
        gUpperLimit.value = "";
      }

      function removeGrade() {
        var insertedGrades = document.getElementById("insertedGrades");
        for(var i = 0; i < insertedGrades.children.length; i++) { // get index of selected Grades
          if(insertedGrades.children[i].selected) {
            insertedGrades.remove(i); // remove by index
          }
        }
      }

      function submitGrades() {
        // get Grades
        var insertedGrades = document.getElementById("insertedGrades");

        var qID = foundQ.qualificationID; // get QualificationID to save
        var grades = new Array();
        // var gradeNames = new array();
        // var gradeUpperLimits = new array();
        for(var i = 0; i < insertedGrades.children.length; i++) { // extract gradeList
          var grade = insertedGrades.children[i].value;
          grades.push(grade);
          // gradeNames.push(grade.substring(0, existingGrade.indexOf(':')));
          // gradeUpperLimits.push(parseInt(grade.substring(existingGrade.indexOf(':') + 1)));
        }

        // get form
        var gradeListForm = document.getElementById("gradeListForm");
        var qID = document.getElementById("qualificationID");
        var gradeList = document.getElementById("qualificationGrades");
        // send gradeList to hidden form input
        qID.value = foundQ.qualificationID;
        gradeList.value = grades;

        if(gradeList.value.length != 0) { // chk if valid
          gradeListForm.submit();
        }
        else {
          var formStatus = document.getElementById("formStatus");
          // prompt to exit
          if(confirm("No Grades in list, save anyway?")) {
            gradeListForm.submit();
          }
          else {

          }
        }
      }

      function testGrades() {
        // get Grades
        var insertedGrades = document.getElementById("insertedGrades");

        var qID = foundQ.qualificationID; // get QualificationID to save
        var grades = new Array();
        // var gradeNames = new array();
        // var gradeUpperLimits = new array();
        for(var i = 0; i < insertedGrades.children.length; i++) { // extract gradeList
          var grade = insertedGrades.children[i].value;
          grades.push(grade);
          // gradeNames.push(grade.substring(0, existingGrade.indexOf(':')));
          // gradeUpperLimits.push(parseInt(grade.substring(existingGrade.indexOf(':') + 1)));
        }

        // get form
        var gradeListForm = document.getElementById("gradeListForm");
        var qID = document.getElementById("qualificationID");
        var gradeList = document.getElementById("qualificationGrades");
        // send gradeList to hidden form input
        qID.value = foundQ.qualificationID;
        gradeList.value = grades;

        var formStatus = document.getElementById("formStatus");
        formStatus.innerHTML = gradeList.value;
      }
      </script>

    </body>
    </html>
