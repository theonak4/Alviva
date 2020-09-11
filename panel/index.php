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
  <img style="margin-left: 3%; margin-top: 5%; margin-bottom: 10;" src="http://54.188.51.218/logotype_t.png" width=125 />
  <h4 style="margin-left: 3%">Welcome, <?php echo $userName; ?></h4>
  <hr style="width: 300px; margin-left: 3%">
  <br>
  <h5><img src="icons/person-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> <strong>player</strong> <?php if(!$readyToPlay) { echo "<span class='badge badge-danger badge-pill'>!</span>"; } ?></h5>
  <br>
  <a href="http://54.188.51.218/panel/profile"><h5><img src="icons/person-bounding-box.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> player profile</h5></a>
  <br>
  <a href="http://54.188.51.218/panel/manager"><h5><img src="icons/people-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> team manager</h5></a>
  <br>
  <a href="http://54.188.51.218/panel/card"><h5><img src="icons/card-heading.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> view player card</h5></a>
  <br>
  <a href="http://54.188.51.218/panel/forms"><h5><img src="icons/card-heading.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> view forms</h5></a>
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
    <h1 style="margin-top: 5%">Your Player</h1>
    <br>

    <div class="media" style="background: #fafafa; padding: 20; width: 600">
      <img src="headshot.jpg" class="mr-3" alt="..." style="width: 60; height: 60; border-radius: 50%">
        <div class="media-body">
          <h4 class="mt-0" style="font-weight: 800; margin-bottom: 0; padding-bottom: 0;"><?php echo $playerFullName; ?></h4>
          <h4 style="margin: 0;"><?php echo $teamName; ?></h4>
        </div>
    </div>
    <div style="width: 600; padding: 5; background: <?php if($readyToPlay) { echo '#28a745'; } else { echo '#dc3545'; } ?>; color: white; text-align: right; padding-right: 20; font-weight: 800">    <!-- Success #136207 -->
      <img src="<?php if($readyToPlay) { echo 'icons/check-all.svg'; } else { echo 'icons/exclamation-triangle.svg'; } ?>" style="width: 30; height: 30; filter: invert(100%); margin-right: 5"></img>
      <?php
        if($readyToPlay) {
          echo "ready to play";
        } else { echo "not ready to play"; }
      ?>
    </div>

    <br>
    <br>
    <h4 style="font-weight: 600">information status</h4>
    <div class="row" style="margin-top: 10">
      <div class="col-4">
        <div class="list-group" id="list-tab" role="tablist" style="width: 600; border: 0;">
          <li class="list-group-item <?php if($birthCert) { echo 'list-group-item-danger'; } else { echo 'list-group-item-danger'; } ?>" style="border-radius: 0;">Birth Certificate <img src="<?php if($birthCert) { echo 'icons/check-all.svg'; } else { echo 'icons/slash-circle-fill.svg'; } ?>" width="20" height="20" style="float: right; margin-top: 2; "></img></li>
          <li class="list-group-item  <?php if($registration) { echo 'list-group-item-danger'; } else { echo 'list-group-item-danger'; } ?>">CalSouth Player Registration Form <img src="<?php if($registration) { echo 'icons/check-all.svg'; } else { echo 'icons/slash-circle-fill.svg'; } ?>" width="20" height="20" style="float: right; margin-top: 2;"></img></li>
          <li class="list-group-item  <?php if($playerCard) { echo 'list-group-item-success'; } else { echo 'list-group-item-danger'; } ?>" style="border-radius: 0;">Player Card <img src="<?php if($playerCard) { echo 'icons/check-all.svg'; } else { echo 'icons/slash-circle-fill.svg'; } ?>" width="20" height="20" style="float: right; margin-top: 2;"></img></a></li>
          <li class="list-group-item  <?php if($insurance) { echo 'list-group-item-success'; } else { echo 'list-group-item-danger'; } ?>">Insurance Waiver <a style="float: right; margin-left: 10; font-weight: 600;" href="http://54.188.51.218/panel/upload/?type=insurance">Upload &raquo;</a> <img src="<?php if($insurance) { echo 'icons/check-all.svg'; } else { echo 'icons/slash-circle-fill.svg'; } ?>" width="20" height="20" style="float: right; margin-top: 2;"></img></li>
          <li class="list-group-item  <?php if($covid) { echo 'list-group-item-success'; } else { echo 'list-group-item-danger'; } ?>" style="border-radius: 0;">COVID-19 Waiver <a style="float: right; margin-left: 10; font-weight: 600;" href="http://54.188.51.218/panel/upload/?type=covid">Upload &raquo;</a> <img src="<?php if($covid) { echo 'icons/check-all.svg'; } else { echo 'icons/slash-circle-fill.svg'; } ?>" width="20" height="20" style="float: right; margin-top: 2;"></img></a></li>

        </div>
      </div>
  </div>
  <br>
  <button type="button" class="btn btn-light btn-lg btn-block" style="width: 600; border-radius: 0; font-size: 18">edit or submit information</button>
  <br>
  <br>
  <!--
  <div class="card" style="width: 600; border-radius: 0;">
    <h5 class="card-header" style="font-weight: 600;">request team change</h5>
      <div class="card-body">
        <p class="card-text">Changed teams? Submit a request to transfer your player's information to the respective coach.</p>
        <a href="#" class="btn btn-dark" style="font-weight: 600; width: 200; border-radius: 0;">file request <img src="icons/folder-symlink.svg" alt="" width="20" height="20" style="filter: invert(100%)"></a>
      </div>
  </div>
-->



  </div>
  <!--
  <div style="position: fixed; width: 50%; height: 100%; top: 17%; left: 49%">
    <h4 style="font-weight: 600;">who is requesting <?php echo $playerFirst; ?>'s info</h4>
    <hr style="width: 600; float: left;">
  <div class="list-group" style="width: 600">

    <?php

    $accessRecords = $conn->query("SELECT * FROM accessrecords WHERE playerId='{$playerId}' AND authorized=0 ORDER BY date DESC LIMIT 2");
    if($accessRecords->num_rows > 0) {
      while($row = $accessRecords->fetch_assoc()) { ?>

        <span href="#" class="list-group-item" style="border: 0; padding: 20; border-radius: 0; padding-bottom: 0;">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1" style="font-weight: 600"><?php echo $row["recipientName"] ?></h5>
            <small><?php echo date("F jS, Y", strtotime($row["date"])) ?></small>
          </div>
          <p class="mb-1"><?php echo $row["reason"] ?></p>
          <hr>
          <form action="release.php" method="POST" style="margin-top: 15px;">
          <input type="hidden" name="recordID" value="<?php echo $row['recordId']; ?>" />
          <button type="submit" class="btn btn-dark" style="width: 70%; border-radius: 0; font-weight: 600;">view request </button><button type="submit" class="btn btn-light" style="width: 29%; margin-left: 1%; border-radius: 0; font-weight: 600;">dismiss </button>
          </form>

       </span><br>

      <?php

    }
  } else { ?>

    <div class="card" style="width: 600; border-radius:0; text-align: center">
      <div class="card-body">
        You're all caught up!
      </div>
    </div>


   <?php  }
    ?>

  </div>
  -->

  <div class="alert alert-primary alert-dismissible fade show" role="alert" style="width: 600; border-radius: 0; display: <?php if($recordAuthorizedSuccess) { echo 'shown'; } else { echo 'none'; } ?>;">
    <strong>Success!</strong> Request authorized.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <!--  <hr style="width: 600; float: left; margin-top: 0; padding-top: 0;">

  <div class="btn-group">
    <a href="http://54.188.51.218/panel/requests"><button type="button" class="btn btn-light btn-lg btn-block" style="width: 295; border-radius: 0; font-size: 18">view all access requests</button></a>
    <a href="http://54.188.51.218/panel/history"><button type="button" class="btn btn-light btn-lg btn-block" style="width: 295; border-radius: 0; font-size: 18; margin-left: 10">view all access history</button></a>
  </div>
</div>-->

  <div class="footer">
  </div>
</body>
