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
  <a href="http://54.188.51.218/panel"><h5><img src="icons/person-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> player <?php if(!$readyToPlay) { echo "<span class='badge badge-danger badge-pill'>!</span>"; } ?></h5></a>
  <br>
  <a href="http://54.188.51.218/panel/manager"><h5><img src="icons/people-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> team manager</h5></a>
  <br>
  <a href="http://54.188.51.218/panel/card"><h5><img src="icons/card-heading.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> view player card</h5></a>
  <br>
  <a href="http://54.188.51.218/panel/forms"><h5><img src="icons/card-heading.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> view forms</h5></a>
  <br>
  <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><h5><img src="icons/bar-chart.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> <strong>statistics</strong></h5></a>
  <p>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body" style="margin-left: 3%; width: 300; padding: 0; border: 0; background: #fafafa; padding-bottom: 15;">
    <br>
    <a><h5><img src="icons/controller.svg" alt="" width="30" height="30" style="margin-left: 10%; margin-right: 5px;"> game statistics</h5></a>
    <a><h5 style="margin-top: 10;"><img src="icons/cone-striped.svg" alt="" width="30" height="30" style="margin-left: 10%; margin-right: 5px;"> penalties</h5></a>
    <hr>
    <a data-toggle="collapse" href="#collapseExample"><center><img src="icons/chevron-up.svg" width="20" style="padding: 0;"></img></center></a>
  </div>
</div>
  <br>
</div>
  <a href="http://54.188.51.218/account/logout.php"><button type="button" class="btn btn-outline-danger" style="width: 300px; font-weight: 800; border-radius: 0; margin-left: 3%">log out</button></a>
  <div style="position: fixed; width: 50%; height: 100%; top: 5%; left: 425px;">
    <h1 style="margin-top: 5%">Infractions</h1>
    <br>

    <div class="media" style="background: #fafafa; padding: 20; width: 600">
      <img src="headshot.jpg" class="mr-3" alt="..." style="width: 60; height: 60; border-radius: 50%">
        <div class="media-body">
          <h4 class="mt-0" style="font-weight: 800; margin-bottom: 0; padding-bottom: 0;"><?php echo $playerFullName; ?></h4>
          <h4 style="margin: 0;"><?php echo $teamName; ?></h4>
        </div>
    </div>
    <br>
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Infraction #</th>
      <th scope="col">Date</th>
      <th scope="col">Type</th>
      <th scope="col">Location</th>
      <th scope="col">Quantity</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-danger">
      <th scope="row">1</th>
      <td>June 1, 2020</td>
      <td>Red Card</td>
      <td>Blues Cup</td>
      <td>1</td>
    </tr>
    <tr class="table-warning">
      <th scope="row">2</th>
      <td>July 2, 2020</td>
      <td>Yellow Card</td>
      <td>Surf Cup</td>
      <td>2</td>
    </tr>
    <tr class="table-warning">
      <th scope="row">3</th>
      <td>July 22, 2020</td>
      <td>Yellow Card</td>
      <td>Albion Cup</td>
      <td>1</td>
    </tr>
  </tbody>
</table>
<button type="button" class="btn btn-dark" style="border-radius: 0; font-size: 15px; font-weight: 600;">Report incorrect infractions</button>



  <div class="footer">
  </div>
</body>
