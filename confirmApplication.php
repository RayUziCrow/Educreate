<?php // Load Applicant Data
$sqlStatus = "";

session_start();
$selectedA = -1;
if(isset($_SESSION['sqlStatus'])) {
  $sqlStatus = $_SESSION['sqlStatus'];
  unset($_SESSION['sqlStatus']);
}

$username = $_SESSION['username'];
$name = $_SESSION['name'];
// $name = $_SESSION['name'];
// $uniID = $_SESSION['uniID'];

// $foundApplicant = $_POST['selectedApplicant'];
// $foundProgID = $_POST['selectedProg'];
$progID = $_POST['programmeID'];

// init db
$conn = new mysqli('localhost', 'root', '', 'educreate');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// dummy data (online)
// $selectedA = 1;

// gen load Application query
// $sql = "SELECT user.Name, email, applicant.*, programmeID, date, status FROM user, applicant, application WHERE application.applicant = '$username' AND application.programmeID = '$foundProgID' AND application.applicant = applicant.Username AND applicant.Username = user.Username LIMIT 1";

// $result = $conn->query($sql); // execute query

// if ($result->num_rows > 0) {
//   $foundApplication = $result->fetch_assoc();
// }

// load matching Qualification
$sql = "SELECT qualification.* FROM qualification, obtQualification, applicant WHERE obtQualification.username = '$username' AND obtQualification.username = applicant.Username AND obtQualification.qualificationID = qualification.qualificationID LIMIT 1";

$result = $conn->query($sql); // execute query

if ($result->num_rows > 0) {
  $foundQ = $result->fetch_assoc();
  $foundQID = $foundQ['qualificationID'];
}

// load possible Grades
$sql = "SELECT grade, scoreUpperLimit FROM gradelist WHERE qualificationID = '$foundQID'";

$result = $conn->query($sql); // execute query

if ($result->num_rows > 0) {
  $foundGrades = [];
  while($row = $result->fetch_assoc()) {
    $foundGrades[] = $row;
  }
} else {
  $foundGrades = "";
}

var_dump($foundGrades);

// load existing Results
$sql = "SELECT subjectName, score FROM result, subject, obtQualification WHERE obtQualification.username = '$username' AND result.obtainedQualificationID = obtQualification.obtQualificationID AND result.subjectID = subject.subjectID"; // gen load Results query

$result = $conn->query($sql); // execute query

if ($result->num_rows > 0) {
  $foundResults = [];
  while($row = $result->fetch_assoc()) {
    $foundResults[] = $row;
  }
}
else {
  $foundResults = "";
}

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
              <a class="nav-link" href="unihome.php">UNIVERSITY DASHBOARD</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="newProgramme.php">ADD PROGRAMME</a>
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
        <p class="text-lighten">Add Results to a Applicant by entering the details below.</p>
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
        <h2 class="section-title"><span id="applicantName">NO_NAME</span></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 mb-4 mb-lg-0">
        <p class="h2">Programme Info</p>
        <p>
          University: <span id="applicantUsername">N/A</span><br/>
          Description: <span id="applicantEmail">N/A</span><br/>
          Closing date: <span id="applicantMobileNo"></span>  
          <button type="submit">Apply</button>
        </p>
        </div>
        <div class="col-lg-7">
          <div class="row">
            <div class="col-lg-6 mb-3">
              
              <div>
                
                <p>
                  
                  
                </p>
                <p id="formStatus"><?php echo $sqlStatus ?></p>
              </div>
            </div>
            <div class="col-lg-6 mb-3">
              <p class="h2">Results:</p>
              <p>
                Qualification: <span id="selectedQ">N/A</span><br/>
                Overall Score: <span id="overallScore">N/A</span><br/>
                Grade: <span id="overallGrade">N/A</span><br/>
              </p>
              <div>
                <h5>Subjects:</h5>
                <!--added Results go here-->
                <select id="loadedResults" class="w-100 mb-3" multiple size="10">
                </select>
              </div>
              <div>
                <button id="btn_finishReview" onclick="finishReview()" class="btn btn-primary">FINISH</button>
              </div>
              <div>
                <form id="reviewApplicationForm" action="reviewApplication_formsubmit.php" method="post">
                  <input type="hidden" id="newStatus" name="newStatus">
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
      // get php value
      // var aInfo = <?php echo json_encode($foundApplication) ?>;
      var foundQ = <?php echo json_encode($foundQ) ?>;
      var foundGrades = <?php echo json_encode($foundGrades) ?>;
      var foundResults = <?php echo json_encode($foundResults) ?>;

      window.onload = loadAllInfo();

      function loadAllInfo() {
         // send php_array to js
        var aUsername = document.getElementById("applicantUsername");
        var aName = document.getElementById("applicantName");
        var aEmail = document.getElementById("applicantEmail");
        var aMobileNo = document.getElementById("applicantMobileNo");
        var aBirthDate = document.getElementById("applicantBirthDate");
        var resultList = document.getElementById("resultList");

        // fill Applicant Info
        aUsername.innerHTML = aInfo.Username;
        aName.innerHTML = aInfo.Name;
        aEmail.innerHTML = aInfo.email;
        aMobileNo.innerHTML = aInfo.MobileNo;
        aBirthDate.innerHTML = aInfo.DateOfBirth;

        // fill Application info
        var dateApplied = document.getElementById("dateApplied");
        var appStatusSelect = document.getElementById("applicationStatus");

        dateApplied.innerHTML = aInfo.date;
        appStatusSelect.value = aInfo.status;

        var formStatus = document.getElementById("formStatus");

        // fill Qualification info
        var selectedQ = document.getElementById("selectedQ");
        var overallScore = document.getElementById("overallScore");
        var overallGrade = document.getElementById("overallGrade");


        selectedQ.innerHTML = foundQ.qualificationName;

        // calculate overallScore & overallGrade
        resultScores = new Array();
        for(var i = 0; i < foundResults.length; i++) {
          resultScores.push(parseFloat(foundResults[i].score));
        }

        gradeNames = new Array();
        gradeUpperLimits = new Array();
        for(var i = 0; i < foundGrades.length; i++) {
          gradeNames.push(foundGrades[i].grade);
          gradeUpperLimits.push(parseFloat(foundGrades[i].scoreUpperLimit));
        }

        var resultCalcFormula = foundQ.resultCalcDescription;
        var subjectCount = foundQ.resultCalcSubjectCount;

        switch(resultCalcFormula) {
          case "avg_highest": case "sum_highest":
            // sort Scores (descending)
            resultScores.sort(function(a, b){return b-a});
            gradeUpperLimits.sort(function(a, b){return b-a});
            break;
          case "avg_lowest": case "sum_lowest":
            // sort Scores (ascending)
            resultScores.sort(function(a, b){return a-b});
            gradeUpperLimits.sort(function(a, b){return a-b});
            break;
        }

        // trim Scores
        var parsedScores = resultScores.slice(0, subjectCount);
        var calculatedScore;

        switch(resultCalcFormula) {
          case "avg_highest": case "avg_lowest":
            // calc Average
            calculatedScore = getAvg(parsedScores);
            break;
          case "sum_highest": case "sum_lowest":
            // calc Sum
            calculatedScore = getSum(parsedScores);
            break;
        }

        formStatus.innerHTML = gradeUpperLimits;

        // calculate Grade
        var matchingUpperLimit;
        switch(resultCalcFormula) {
          case "avg_highest": case "sum_highest":
            for(var i = 0; i < gradeUpperLimits.length; i++) {
              if(calculatedScore >= gradeUpperLimits[i]) {
                matchingUpperLimit = gradeUpperLimits[i];
                break;
              }
            }
            break;
          case "avg_lowest": case "sum_lowest":
            for(var i = 0; i < gradeUpperLimits.length; i++) {
              if(calculatedScore <= gradeUpperLimits[i]) {
                matchingUpperLimit = gradeUpperLimits[i];
                break;
              }
            }
            break;
        }

        var matchingGrade = "No Grade"
        // find matching gradeName
        for(var i = 0; i < foundGrades.length; i++) {
          if(matchingUpperLimit == foundGrades[i].scoreUpperLimit) {
            matchingGrade = foundGrades[i].grade;
            break;
          }
        }

        // display values
        overallScore.innerHTML = calculatedScore;
        overallGrade.innerHTML = matchingGrade;

        // fill existing Results
        var loadedResults = document.getElementById("loadedResults");
        for(var i = 0; i < foundResults.length; i++) {
          // create Result
          var newResult = document.createElement("option");
          var newResultText = document.createTextNode(foundResults[i].resultName + ": " + foundResults[i].score);
          newResult.appendChild(newResultText);
          newResult.value = foundResults[i].resultID + ":" + foundResults[i].resultName + ":" + foundResults[i].score;
          // insert Result
          loadedResults.appendChild(newResult);
        }
      }

      function getSum(numArray) {
        var sum = 0;
        for(var i = 0; i < numArray.length; i++) {
          sum += numArray[i];
        }
        return sum;
      }

      function getAvg(numArray) {
        var sum = getSum(numArray);
        return sum / numArray.length;
      }
      </script>

    </body>
    </html>
