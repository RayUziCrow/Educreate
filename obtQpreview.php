<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educreate: View Obtained Qualification</title>

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
<?php

session_start();

$username = $_SESSION['username'];
$name = $_SESSION['name'];
$qualificationName = "";

$conn = new mysqli('localhost', 'root', '', 'educreate');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }





$sql = "SELECT * FROM obtQualification, result, qualification, subject WHERE obtQualification.username = '$username' AND result.obtainedQualificationID = obtQualification.obtQualificationID AND qualification.qualificationID = obtQualification.qualificationID AND subject.subjectID = result.subjectID";

$result = $conn->query($sql);

?>
<!-- header -->
<header class="fixed-top header">
  <!-- top header -->
  <div class="top-header py-2 bg-white">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-4 text-center text-lg-left">

          <ul class="list-inline d-inline">

            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#"><?php echo $username;?></a></li>
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#"><?php echo $name; ?></a></li>
          </ul>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
          <ul class="list-inline">
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="notice.html"></li>
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="research.html"></li>
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="scholarship.html"></li>
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
              <a class="nav-link" id="manageObtQLink">Obtained Qualification</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="obtQpreview.php">View Obtained Qualification</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="viewprogramme.php">Apply for Programme</a>
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

                    <form name="login" class="form-horizontal" role="form"
    method="post" action="">
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="Username" name="Username" placeholder="Username">
                        </div>
                        <div class="col-12">
                            <input type="password" class="form-control mb-3" id="password" name="password" placeholder="Password">
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
<?php
require('Connections/Myconnection.php');
// If form submitted, insert values into the database.
if (isset($_POST['Username'])){
        // removes backslashes
    $username = stripslashes($_REQUEST['Username']);
        //escapes special characters in a string
    $username = mysqli_real_escape_string($con,$username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con,$password);
    //Checking is user existing in the database or not
    $query = "SELECT * FROM user,applicant WHERE user.Username='$username'
and Password='".md5($password)."' and applicant.Username = '$username'";
    $result = mysqli_query($con,$query);
    $rows = mysqli_num_rows($result);
        if($rows==1){
        $_SESSION['Username'] = $username;
            // Redirect user to helpinghandproviderprofile.php
        header("Location: helpinghandproviderprofile.php");
         }else{
echo "<div class='form'>
<h3>Login failed. Invalid User or incorrect password</h3>
<br/>Click here to <a href='apphome.php'>Retry</a></div>";
    }
    }else{
?>
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
              <form name="login" class="form-horizontal" role="form"
    method="post" action="">
                    <div class="col-12">
                        <input type="text" class="form-control mb-3" name="username" placeholder="Username">
                    </div>
                    <div class="col-12">
                        <input type="password" class="form-control mb-3" name="password" placeholder="Password">
                    </div>
                    <div class="col-12">
                        <input type="submit" class="btn btn-primary">LOGIN</button>
                    </div>
                </form>
                  <?php } ?>
            </div>
        </div>
    </div>
</div>


<!-- hero slider -->
<section class="hero-section overlay bg-cover" data-background="images/banner/banner-1.jpg">

  <div class="container">
    <div class="list-group"><a href="#" class="list-group-item list-group-item-action flex-column align-items-start"><div class="d-flex w-70 justify-content-between">
    	<h5>Qualification results : </h5></div></a>

    	<?php if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {
?>
      	 <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-70 justify-content-between">
          <h5 class="mb-1"><?php echo $row['subjectName']; ?></h5>
          <small><?php echo $row['qualificationName']; ?></small>
        </div>
        <p class="mb-1"><?php echo $row['score']; ?></p>
        <small></small>
      </a>

<?php

      }
}

?>
</div>
</section>
<!-- /hero slider -->

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
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="plugins/google-map/gmap.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>

<script>

function checkexistobtQ(hasObtQ) {

  if (hasObtQ != -1)
  {
    var overwrite = confirm("Do you want to overwrite your existing qualification? ");
    if (overwrite == true)
    {
    window.location = "obtainedQualification.php";
    }
    else
    {
    return false;
    }

  }
  else {
    window.location = "obtainedQualification.php";
          }


}
</script>

</body>
</html>
