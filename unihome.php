<?php
session_start();

$sqlStatus = "";
if(isset($_SESSION['formSubmit'])) { // chk if submitted
  $sqlStatus = $_SESSION['sqlStatus'];
  unset($_SESSION['sqlStatus']);
}

require_once('Connections/Myconnection.php');

//include auth.php file on all secure pages
include("auth.php");

$username = $_SESSION['username'];
$name = $_SESSION['name'];
// $name = "NO_NAME";
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//To retrieve user attributes
$sql = "SELECT * FROM user WHERE Username = '$username'";

$result = $con->query($sql); // execute query

// if ($result->num_rows > 0) {
//   while($row = $result->fetch_assoc()) {
//     $name = $row['Name'];
//   }
// }

$con->close();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educreate: University Dashboard</title>

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
            <li class="nav-item active">
              <a class="nav-link" href="unihome.php">UNIVERSITY DASHBOARD</a>
            </li>
            <li class="nav-item @@contact">
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
<!-- Modal -->
<div class="modal fade" id="qualificationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Manage Qualifications</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="manageQualifications">
                  <div class="row justify-content-center">
                    <!-- course item -->
                    <div class="col-lg-4 col-sm-6 mb-5">
                      <div class="card p-0 border-primary rounded-0 hover-shadow">

                        <div class="card-body">

                          <a href="newQualification.php">
                            <h4 class="card-title">New Qualification</h4>
                          </a>
                          <p class="card-text mb-4"> Record a new Qualification.</p>
                          <a href="newQualification.php" class="btn btn-primary btn-sm">Create</a>
                        </div>
                      </div>
                    </div>
                    <!-- course item -->
                    <div class="col-lg-4 col-sm-6 mb-5">
                      <div class="card p-0 border-primary rounded-0 hover-shadow">

                        <div class="card-body">

                          <a href="editQualification.php">
                            <h4 class="card-title">Edit Qualification</h4>
                          </a>
                          <p class="card-text mb-4"> Edit an existing Qualification.</p>
                          <a href="editQualification.php" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
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
          <li class="list-inline-item"><span class="h2 text-primary font-secondary">University Dashboard</span></li>
          <li class="list-inline-item text-white h3 font-secondary "></li>
        </ul>
        <p class="text-lighten">Add a Programme to the University, or review Applications for existing Programmes.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- courses -->
<section class="section">
  <div class="container">
    <!-- course list -->
<div class="row justify-content-center">
  <!-- course item -->
  <div class="col-lg-4 col-sm-6 mb-5">
    <div class="card p-0 border-primary rounded-0 hover-shadow">

      <div class="card-body">

        <a data-toggle="modal" data-target="#qualificationModal">
          <h4 class="card-title">Add Programme</h4>
        </a>
        <p class="card-text mb-4"> Add a new Programme into the University.</p>
        <a href="#" data-toggle="modal" data-target="#qualificationModal" class="btn btn-primary btn-sm">Add</a>
      </div>
    </div>
  </div>
  <!-- course item -->
  <div class="col-lg-4 col-sm-6 mb-5">
    <div class="card p-0 border-primary rounded-0 hover-shadow">

      <div class="card-body">

        <a href="registerUni.php">
          <h4 class="card-title">Review Applications</h4>
        </a>
        <p class="card-text mb-4"> Review Applications for existing Programmes.</p>
        <a href="registerUni.php" class="btn btn-primary btn-sm">Review</a>
      </div>
    </div>
  </div>

</div>
<!-- /course list -->
<div class="row justify-content-center">
  <div>
    <h2 class="section-title">Programmes</h2>
  </div>
</div>
<div class="row justify-content-center">
  <div class="list-group">
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-70 justify-content-between">
        <h5 class="mb-1">Bachelor's Degree In Finance</h5>
        <small>3 days ago</small>
      </div>
      <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
      <small>Donec id elit non mi porta.</small>
    </a>
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-70 justify-content-between">
        <h5 class="mb-1">Diploma In Business Studies</h5>
        <small class="mb-1">3 days ago</small>
      </div>
      <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
      <small class="mb-1">Donec id elit non mi porta.</small>
    </a>
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-70 justify-content-between">
        <h5 class="mb-1">Degree In Psychology</h5>
        <small class="mb-1">3 days ago</small>
      </div>
      <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
      <small class="mb-1">Donec id elit non mi porta.</small>
    </a>
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-70 justify-content-between">
        <h5 class="mb-1">Degree In Psychology</h5>
        <small class="mb-1">3 days ago</small>
      </div>
      <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
      <small class="mb-1">Donec id elit non mi porta.</small>
    </a>
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-70 justify-content-between">
        <h5 class="mb-1">Degree In Psychology</h5>
        <small class="mb-1">3 days ago</small>
      </div>
      <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
      <small class="mb-1">Donec id elit non mi porta.</small>
    </a>
  </div>
</div>
    <!-- course list -->

  </div>
</section>
<!-- /courses -->

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
            © Theme By <a href="https://themefisher.com">themefisher.com</a></p> . All Rights Reserved.<p/>
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
</script>

</body>
</html>
