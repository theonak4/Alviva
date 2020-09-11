<?php
session_start();
error_reporting(0);

$recordAuthorizedSuccess = $_GET["recordAuthorizedSuccess"];

// Initialize user variables
$user = "";
$userID = "";
$userName = "";

// Initialize Player Variables
$playerFullName = "";
$playerFirst = "";
$playerId = "";
$teamID = "";
$birthCert = 0;
$registration = 0;
$playerCard = 0;
$insurance = 0;
$covid = 0;
$readyToPlay = 0;

$teamName = "";

if($_SESSION["loggedIn"] == false) {
  header("Location: http://54.188.51.218");
} else {

  $user = $_SESSION["user"];

  $conn = new mysqli("#########", "####", "######", "#######");
  if($conn->connect_error) {
    header("Location: http://54.188.51.218");
  }

  // Fetch current user information
  $getUserInfo = $conn->query("SELECT * FROM users WHERE email='{$user}'");
  if($getUserInfo->num_rows > 0) {
    while($row = $getUserInfo->fetch_assoc()) {
      $userName = $row["firstName"];
      $userID = $row["id"];
    }
  }

  // Fetch associated player's information
  $getPlayerInfo = $conn->query("SELECT * FROM players WHERE assocParentUserID='{$userID}'");
  if($getPlayerInfo->num_rows > 0) {
    while($row = $getPlayerInfo->fetch_assoc()) {
      $playerFullName = $row["firstName"] . " " . $row["lastName"];
      $playerFirst = $row["firstName"];
      $teamID = $row["assocTeamID"];
      $birthCert = $row["birthCertificateStatus"];
      $registration = $row["regStatus"];
      $playerCard = $row["cardStatus"];
      $insurance = $row["insuranceStatus"];
      $covid = $row["covidStatus"];
      $playerId = $row["id"];
    }
  }

  if($birthCert == 1 && $registration == 1 && $playerCard == 1 && $insurance == 1 && $covid == 1) {
    $readyToPlay = 1;
  } else {
    $readyToPlay = 0;
  }

  // Fetch associated team's information
  $getTeamInfo = $conn->query("SELECT * FROM teams WHERE id='{$teamID}'");
  if($getTeamInfo->num_rows > 0) {
    while($row = $getTeamInfo->fetch_assoc()) {
      $teamName = $row["teamName"];
    }
  }

  $getAR = $conn->query("SELECT * FROM accessrecords WHERE playerId={$playerId} AND authorized=0");
  $arNotifs = $getAR->num_rows;


}

 ?>

 <head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Merriweather:wght@700&family=Montserrat:wght@300;400;800;900&display=swap" rel="stylesheet">

<style>
body, html {
  padding: 0;
  margin: 0;
  margin-left: 0%;
  margin-top: 0%;
  font-family: "Montserrat";
}

.footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background: #F5F5F5;
  height: 5%;
  padding-left: 3%;
  padding-top: 30;
}

a {
  color: black;
}

a:hover {
  text-decoration: none;
  font-weight: 600;
  color: black;
}

</style>


</head>

<body>
  <h1 style="font-weight: 900; margin-left: 3%; margin-top: 5%">alviva</h1>
  <h4 style="margin-left: 3%">Welcome, <?php echo $userName; ?></h4>
  <hr style="width: 300px; margin-left: 3%">
  <br>
  <a href="http://54.188.51.218/panel/"><h5><img src="icons/person-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> player <?php if(!$readyToPlay) { echo "<span class='badge badge-danger badge-pill'>!</span>"; } ?></h5></a>
  <br>
  <a href="http://54.188.51.218/panel/manager"><h5><img src="icons/people-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> team manager</h5></a>
  <br>
  <a href="http://54.188.51.218/panel/card"><h5><img src="icons/card-heading.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> view player card</h5></a>
  <br>
  <h5><img src="icons/card-heading.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> <strong>view forms</strong></h5>
  <br>
  <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><h5><img src="icons/bar-chart.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> statistics</h5></a>
  <p>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body" style="margin-left: 3%; width: 300; padding: 0; border: 0; background: #fafafa; padding-bottom: 15;">
    <br>
    <a href="http://54.188.51.218/panel/statistics"><h5><img src="icons/controller.svg" alt="" width="30" height="30" style="margin-left: 10%; margin-right: 5px;"> game statistics</h5></a>
    <a><h5 style="margin-top: 10;"><img src="icons/cone-striped.svg" alt="" width="30" height="30" style="margin-left: 10%; margin-right: 5px;"> penalties</h5></a>
    <hr>
    <a data-toggle="collapse" href="#collapseExample"><center><img src="icons/chevron-up.svg" width="20" style="padding: 0;"></img></center></a>
  </div>
</div>
  <br>
  <a href="http://54.188.51.218/account/logout.php"><button type="button" class="btn btn-outline-danger" style="width: 300px; font-weight: 800; border-radius: 0; margin-left: 3%">log out</button></a>
  <div style="position: fixed; width: 50%; height: 100%; top: 5%; left: 425px;">
    <h1 style="margin-top: 5%">Club Forms</h1>
    <br>
    <a href="http://54.188.51.218/panel/forms/club/csf.pdf" target="_blank"><button type="button" class="btn btn-light btn-lg" style="border-radius: 0; width: 600;">view CalSouth Youth Player Registration Form <img src="icons/chevron-double-right.svg" width="20"></img></button></a><br><br>
    <a href="http://54.188.51.218/panel/forms/club/usf.pdf" target="_blank"><button type="button" class="btn btn-light btn-lg" style="border-radius: 0; width: 600;">view US Soccer Youth Player Registration Form <img src="icons/chevron-double-right.svg" width="20"></img></button></a><br><br>
    <br>
    <hr>
    <small><strong>PERSONAL FORMS</strong></small>
    <br>
    <br>
    <a href="http://54.188.51.218/panel/forms/club/bc.png" target="_blank"><button type="button" class="btn btn-light btn-lg" style="border-radius: 0; width: 600;">view Birth Certificate <img src="icons/chevron-double-right.svg" width="20"></img></button></a><br><br>
    <a href="http://54.188.51.218/panel/forms/club/csf.pdf" target="_blank"><button type="button" class="btn btn-light btn-lg" style="border-radius: 0; width: 600;">view Attatchable Player's Card <img src="icons/chevron-double-right.svg" width="20"></img></button></a><br><br>
    <a href="http://54.188.51.218/panel/forms/club/covid.pdf" target="_blank"><button type="button" class="btn btn-light btn-lg" style="border-radius: 0; width: 600;">view COVID-19 Waiver <img src="icons/chevron-double-right.svg" width="20"></img></button></a><br><br>
    <a href="http://54.188.51.218/panel/forms/club/insur.jpg" target="_blank"><button type="button" class="btn btn-light btn-lg" style="border-radius: 0; width: 600;">view Insurance Waiver <img src="icons/chevron-double-right.svg" width="20"></img></button></a><br><br><br>
    <a href="http://54.188.51.218/panel/forms"><button type="button" class="btn btn-outline-primary" style="border-radius: 0;">back to all forms</button> <button type="button" class="btn btn-outline-success" style="border-radius: 0; margin-left: 10; font-weight: 600;">send completed forms for review</button></a>



  <div class="footer">
  </div>
</body>
