<?php
//include auth.php file on all secure pages
// include("auth.php");
session_start();

$sqlStatus = "";
if(isset($_SESSION['formSubmit'])) { // chk if submitted
  $sqlStatus = $_SESSION['sqlStatus'];
  unset($_SESSION['sqlStatus']);
}

$username = $_SESSION['username'];
$name = $_SESSION['name'];

// init db
$conn = new mysqli('localhost', 'root', '', 'educreate');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// get User info
$sql = "SELECT * FROM user WHERE Username = '$username' LIMIT 1";

$result = $conn->query($sql); // execute query

if ($result->num_rows > 0) {
  // gen getApplications query
  $sql = "SELECT application.programmeID, universityName, name, date, status FROM application, programme, university WHERE applicant = '$username' AND programme.programmeID = application.programmeID AND programme.universityID = university.UniversityID";

  $result = $conn->query($sql); // execute query

  if ($result->num_rows > 0) {
    $currentApplications = [];
    while($row = $result->fetch_assoc()) {
      $currentApplications[] = $row;
    }
  } else {
    $currentApplications = "";
  }
}

// get Programmes
$sql = "SELECT programme.*, university.UniversityName FROM programme, university WHERE programme.universityID = university.universityID";

$result = $conn->query($sql); // execute query

if ($result->num_rows > 0) {
  $foundProgs = [];
  while($row = $result->fetch_assoc()) {
    $foundProgs[] = $row;
  }
} else {

}

// load matching Qualification
$sql = "SELECT qualification.* FROM qualification, obtQualification, applicant WHERE obtqualification.username = '$username' AND obtqualification.username = applicant.Username AND obtqualification.qualificationID = qualification.qualificationID LIMIT 1";

$result = $conn->query($sql); // execute query

if ($result->num_rows > 0) {
  $foundQ = $result->fetch_assoc();
  $foundQID = $foundQ['qualificationID'];
}

// load existing Results
$sql = "SELECT subjectName, score FROM result, subject, obtqualification WHERE obtqualification.username = '$username' AND result.obtainedQualificationID = obtqualification.obtQualificationID AND result.subjectID = subject.subjectID"; // gen load Results query

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

$conn->close();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educreate: Applicant Profile</title>

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
          <a class="navbar-brand" href="apphome.php"><img src="images/logo.png" alt="logo"></a>
          <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item">
              <a class="nav-link" href="apphome.php">APPLICANT DASHBOARD</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="obtainedQualification.php" id="manageObtQLink">Obtained Qualification</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="viewprogramme.php">Apply for Programme</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>
<!-- /header -->

<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><span class="h2 text-primary font-secondary">Apply for Programme</span></li>
          <li class="list-inline-item text-white h3 font-secondary "></li>
        </ul>
        <p class="text-lighten">Apply for a Programme by selecting one from the list.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- hero slider -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div>
        <h2 class="section-title">Programmes List</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="list-group" id="progListMenu">
        <a class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-70 justify-content-between">
            <h5 class="mb-1">Bachelor's Degree In Finance</h5>
            <span>University: myUni</span>
          </div>
          <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
          <br/>
          <div class="d-flex w-70 justify-content-between">
            <span>Closing Date: 12/7/2019</span>
            <button onclick="testVar(appliedProgs)">[BUTTON]</button>
          </div>
        </a>
      </div>
      <form id="appform" action="confirmApplication.php" method="post">
        <input type="hidden" id="applicant" name="applicant" value="<?php echo $username ?>">
        <input type="hidden" id="programmeID" name="programmeID">
        <input type="hidden" id="currentDate" name="currentDate">
      </form>
    </div>

  </div>
</section>

<!-- footer -->
<footer>
  <!-- newsletter -->

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
    var sqlStatus = "<?php echo $sqlStatus ?>";
    if(sqlStatus != "") {
      alert(sqlStatus);
    }

    var appliedProgs = <?php echo json_encode($currentApplications) ?>;
    var progList = <?php echo json_encode($foundProgs) ?>;
    var foundQ = <?php echo json_encode($foundQ) ?>;
    var foundResults = <?php echo json_encode($foundResults) ?>;
    var calculatedScore;
    var applicantPercentScore;

    window.onload = loadProgrammes();

    function chooseProgramme(pID) {
      // chk if can apply

      // get current date
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      today = yyyy + '-' + mm + '-' + dd;

      if(today > progList[pID].closingDate) { // chk closingDate
        // closed
        alert("Sorry, Applications are closed for this Programme.");
      } else if(applicantPercentScore < progList[pID].entryScore) { // chk entryScore
        alert("Sorry, you are not qualified to apply for this Programme.");
      } else { // can apply
        if(confirm("Are you sure you wish to apply?")) {
          // apply
          var chosenProgform = document.getElementById("appform");
          var chosenProg = document.getElementById("programmeID");
          var currentDate = document.getElementById("currentDate");
          chosenProg.value = pID + 1;
          currentDate.value = today;
          chosenProgform.submit();
        }
      }
    }

    function loadProgrammes() {
      var progListMenu = document.getElementById("progListMenu");

      if(progList.length != 0) {
        for(var i = 0; i < progList.length; i++) {
          // gen Programme list item
          var progItem = document.createElement("a");

          var progItemDivUpper = document.createElement("div");
          var progItemH5 = document.createElement("h5");
          var progItemSpanUpper = document.createElement("span");

          var progItemP = document.createElement("p");
          var progItemBr = document.createElement("br");

          var progItemDivLower = document.createElement("div");
          var progItemSpanLower1 = document.createElement("span");
          var progItemSpanLower2 = document.createElement("button");

          var txtnodeProgName = document.createTextNode(progList[i].name);
          var txtnodeDesc = document.createTextNode(progList[i].description);
          var txtnodeUniName = document.createTextNode("University: " + progList[i].UniversityName);
          // var txtnodeEntryScore = document.createTextNode("Entry Score: " + progList[i].entryScore + "%");
          var txtnodeClosingDate = document.createTextNode("Closing Date: " + progList[i].closingDate);

          // chk for already appliedProgs
          var txtnodeApply = document.createTextNode("Apply");
          var progToChk = progList[i];
          // chk if have appliedProgs
          if(appliedProgs.length > 0) {
            for(var i = 0; i < appliedProgs.length; i++) { // chk if prog is applied
              if (appliedProgs[i].programmeID == progToChk.programmeID) {
                txtnodeApply = document.createTextNode("Applied");
                progItemSpanLower2.disabled = "disabled";
                break;
              }
            }
          }

          progItemH5.appendChild(txtnodeProgName);
          progItemSpanUpper.appendChild(txtnodeUniName);
          progItemP.appendChild(txtnodeDesc);
          progItemSpanLower1.appendChild(txtnodeClosingDate);
          progItemSpanLower2.appendChild(txtnodeApply);

          progItem.setAttribute("class", "list-group-item list-group-item-action flex-column align-items-start");
          progItemDivUpper.setAttribute("class", "d-flex w-70 justify-content-between");
          progItemDivLower.setAttribute("class", "d-flex w-70 justify-content-between");
          progItemH5.setAttribute("class", "mb-1");
          progItemP.setAttribute("class", "mb-1");
          progItemSpanLower2.setAttribute("onclick", "chooseProgramme("+ (progList[i].programmeID - 1) +")");

          progItemDivUpper.appendChild(progItemH5);
          progItemDivUpper.appendChild(progItemSpanUpper);
          progItemDivLower.appendChild(progItemSpanLower1);
          progItemDivLower.appendChild(progItemSpanLower2);

          progItem.appendChild(progItemDivUpper);
          progItem.appendChild(progItemP);
          progItem.appendChild(progItemBr);
          progItem.appendChild(progItemDivLower);

          // attach progItem to list
          progListMenu.appendChild(progItem);
        }
      }

      // calculate overallScore
      resultScores = new Array();
      for(var i = 0; i < foundResults.length; i++) {
        resultScores.push(parseFloat(foundResults[i].score));
      }

      var resultCalcFormula = foundQ.resultCalcDescription;
      var subjectCount = foundQ.resultCalcSubjectCount;

      switch(resultCalcFormula) {
        case "avg_highest": case "sum_highest":
          // sort Scores (descending)
          resultScores.sort(function(a, b){return b-a});
          break;
        case "avg_lowest": case "sum_lowest":
          // sort Scores (ascending)
          resultScores.sort(function(a, b){return a-b});
          break;
      }

      // trim Scores
      var parsedScores = resultScores.slice(0, subjectCount);

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

      // convert score to %
      // deterimine total Score Range
      var scoreRange = foundQ.maximumScore - foundQ.minimumScore;
      if(scoreRange < 0) {
        scoreRange *= -1;
      }
      // convert based on Highest/Lowest
      switch(resultCalcFormula) {
        case "avg_highest": case "sum_highest":
          applicantPercentScore = ((calculatedScore - foundQ.minimumScore) * 100) / scoreRange;
          break;
        case "avg_lowest": case "sum_lowest":
          applicantPercentScore = 100 - (((calculatedScore - foundQ.minimumScore) * 100) / scoreRange);
          break;
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

    function testVar(myVar) {
      alert(myVar);
    }
    </script>

  </body>
  </html>
