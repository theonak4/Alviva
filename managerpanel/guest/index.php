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
  padding: 15px;
  padding-top: 13;
  padding-left: 3%;
  text-align: right;
  font-size: 21;
  padding-right: 2%;
}


</style>


</head>

<body>
  <h1 style="font-weight: 900; margin-left: 3%; margin-top: 5%">alviva</h1>
  <h4 style="margin-left: 3%">Welcome, <?php echo $userName; ?></h4>
  <hr style="width: 300px; margin-left: 3%">
  <br>
  <a href="http://54.188.51.218/managerpanel" style="color: black"><h5><img src="icons/person-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> your team</h5></a>
  <br>
  <h5><img src="icons/people-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> <strong>guest players</strong></h5>
  <br>
  <a href="http://54.188.51.218/managerpanel/requests" style="color: black"><h5><img src="icons/box-arrow-in-right.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> access requests <?php if($getAR->num_rows > 0) { echo "<span class='badge badge-primary badge-pill'>{$arNotifs}</span>"; } ?></h5></a>
  <br>
  <a href="http://54.188.51.218/managerpanel/history" style="color: black"><h5><img src="icons/book-half.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> access history</h5></a>
  <br>
  <a href="http://54.188.51.218/account/logout.php"><button type="button" class="btn btn-outline-danger" style="width: 300px; font-weight: 800; border-radius: 0; margin-left: 3%">log out</button></a>
  <div style="position: fixed; width: 50%; height: 100%; top: 5%; left: 425px;">
    <h1 style="margin-top: 5%">Guest Player Lookup</h1>
    <h5>Search alviva's database to find guest player information</h5>
    <hr style="margin-top: 19;">
    <form>
  <div class="row">
    <div class="col" style="width: 400;">
      <div class="form-group">
      <label for="exampleInputEmail1" style="margin-bottom: 3;"><strong>first name</strong></label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="border-radius: 0; ">
      <small id="emailHelp" class="form-text text-muted">Please do not use nicknames.</small>
    </div>
    </div>
    <div class="col">
      <div class="form-group">
      <label for="exampleInputEmail1" style="margin-bottom: 3;"><strong>last name</strong></label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="border-radius: 0; ">
    </div>
    </div>
  </div>
  <div class="row">
    <div class="col" style="width: 400;">
      <div class="form-group">
      <label for="exampleInputEmail1" style="margin-bottom: 3;"><strong>team</strong></label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="border-radius: 0; ">
    </div>
    </div>

  </div>
</form>

<div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">I have read and understand the <a href="">guest player agreement</a>.</label>
  </div>
<button type="button" class="btn btn-primary" style="font-weight: 600; border-radius: 0; width: 300;">lookup</button>

  </div>


  <div class="footer">
    <!--&copy; <strong>blaze</strong>sports-->
  </div>
  <div class="toast" data-autohide="false" style="position: fixed; top: 3%; right: 3%;font-family: Montserrat; border: 0;">
  <div class="toast-header">
    <strong class="mr-auto"><strong>UPCOMING EVENTS</strong></strong>
    <small class="text-muted"></small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
  </div>
  <div class="toast-body" style="width: 400;">
   <span style="font-size: 16;">Your team is scheduled to participate in <br>the Blues Cup on August 20, 2020.</span><br>
   <a href="">view more <img src="icons/arrow-right-short.svg"></img></a>
  </div>
  <button type="button" class="btn btn-primary" style="border-radius: 0; width: 100%; font-size: 15;"><strong>send team info to organizer <img src="icons/box-arrow-in-right.svg" style="margin-right: 5; filter: invert(100%); width: 20; margin-bottom: 2;"></img></strong></button>
</div>

<script>
$('.toast').toast('show');
</script>
</body>
