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

.form-control {
  border-radius: 0;
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


</style>


</head>

<body>
  <h1 style="font-weight: 900; margin-left: 3%; margin-top: 5%">alviva</h1>
  <h4 style="margin-left: 3%">Welcome, SoCal Blues</h4>
  <hr style="width: 300px; margin-left: 3%">
  <br>
  <a href="http://54.188.51.218/organizerpanel" style="color: black"><h5><img src="managericon.png" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> your profile</h5></a>
  <br>
  <h5><img src="icons/calendar-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> <strong>club registrar</strong></h5></a>
  <br>
  <a href="http://54.188.51.218/account/logout.php"><button type="button" class="btn btn-outline-danger" style="width: 300px; font-weight: 800; border-radius: 0; margin-left: 3%">log out</button></a>
  <div style="position: fixed; width: 50%; height: 100%; top: 5%; left: 425px;">
    <h1 style="margin-top: 5%">Club Registrar</h1>
    <br>
    <h5><strong>EVENT CREATION</strong></h5>
    <hr>
    <br>
    <h6 style="font-size: 14"><strong>EVENT INFORMATION</strong></h6>
    <form action="createrequest.php" method="GET">
  <div class="form-group">
    <label for="inputAddress">event name</label>
    <input type="text" class="form-control" name="event-name" placeholder="ex: Example Tournament">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">start date</label>
      <input type="date" class="form-control" name="event-start" id="inputEmail4">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">end date</label>
      <input type="date" class="form-control" id="inputPassword4">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress2">event location address</label>
    <input type="text" class="form-control" id="inputAddress2">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">event location city</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">event location state</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>CA</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">event location zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <br>
      <h6 style="font-size: 14"><strong>NECCESSARY INFORMATION</strong></h6>
      <h6>What do you need from teams participating?</h6>
      <hr>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="info1" value=1>
        <label class="form-check-label" for="exampleRadios1">
          Birth Certificates
        </label><br>
        <input class="form-check-input" type="checkbox" name="info2" value=1>
        <label class="form-check-label" for="exampleRadios1">
          CalSouth Registration Forms
        </label><br>
        <input class="form-check-input" type="checkbox" name="info3" value=1>
        <label class="form-check-label" for="exampleRadios1">
          Player Cards
        </label><br>
        <input class="form-check-input" type="checkbox" name="info4" value=1>
        <label class="form-check-label" for="exampleRadios1">
          Insurance Waivers
        </label><br>
        <input class="form-check-input" type="checkbox" name="info5" value=1>
        <label class="form-check-label" for="exampleRadios1">
          COVID-19 Waivers
        </label>
      </div>
    </div>
    <div class="form-group col-md-6">
      <br>
      <h6 style="font-size: 14"><strong>PARTICIPATING TEAMS</strong></h6>
      <h6>Select teams to invite.</h6>
      <hr>
      <div class="input-group mb-3" style="border-radius: 0; margin-top: 15;">
  <input type="text" class="form-control" placeholder="Search team by name / ID" aria-label="Recipient's username" aria-describedby="button-addon2" style="border-radius: 0;">
  <div class="input-group-append" style="border-radius: 0;">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2" style="border-radius: 0;">Add to Invite List</button>
  </div>
</div>
    </div>
  </div>

  <br>
  <br>
  <br>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="guidelines-agreement">
      <label class="form-check-label" for="gridCheck">
        I have read and agree to the <a href="54.188.51.218/eventguidlines">event organizer guidelines</a>.
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" style="border-radius: 0; width: 300;"><strong>create event</strong></button><a href="http://54.188.51.218/organizerpanel"><button type="button" class="btn btn-light" style="border-radius: 0; width: 150; margin-left: 10"><strong>cancel</strong></button></a>
</form>

  </div>


  <div class="footer">
  </div>
</body>
