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
  <a href="http://54.188.51.218/panel/"><h5><img src="icons/person-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> player <?php if(!$readyToPlay) { echo "<span class='badge badge-danger badge-pill'>!</span>"; } ?></h5></a>
  <br>
  <h5><img src="icons/person-bounding-box.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> <strong>player profile</strong></h5>
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
    <h1 style="margin-top: 5%">Player Profile</h1>
    <br>

    <div class="accordion" id="accordionExample" style="color: black; border: 0;">
  <div class="card" style="border: 0;">
    <div class="card-header" id="headingOne" style="border-radius: 0; padding: 0;">
      <div style="width: 100%; height: 5; background: linear-gradient(to right, #3399ff, #6600ff); float: top;"></div>
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color: black; padding: 25;">
          <strong>Basic Info</strong>
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <div class="media" style="background: #fafafa; padding: 20; width: 600">
          <img src="http://54.188.51.218/panel/headshot.jpg" class="mr-3" alt="..." style="width: 60; height: 60; border-radius: 50%">
            <div class="media-body">
              <h4 class="mt-0" style="font-weight: 800; margin-bottom: 0; padding-bottom: 0;"><?php echo $playerFullName; ?></h4>
              <h4 style="margin: 0;"><?php echo $teamName; ?></h4>
            </div>
        </div>
        <br>
        <table class="table">
  <tbody>
    <tr>
      <td><strong>Name</strong></td>
      <td>Ava Johnson</td>
    </tr>
    <tr>
      <td><strong>Graduation Year</strong></td>
      <td>2022</td>
    </tr>
    <tr>
      <td><strong>Date of Birth</strong></td>
      <td>May 24, 2006</td>
    </tr>
    <tr>
      <td><strong>Club Name</strong></td>
      <td>SoCal Blues</td>
    </tr>
    <tr>
      <td><strong>Position</strong></td>
      <td>Midfield</td>
    </tr>
    <tr>
      <td><strong>School</strong></td>
      <td>Carlsbad High School</td>
    </tr>
    <tr>
      <td><strong>Region</strong></td>
      <td>Southen California</td>
    </tr>
  </tbody>
</table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" style="border-radius: 0;" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <strong>Overview</strong>
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <textarea style="width: 100%; border: 0; resize: both;" type="text" cols=50 rows=10></textarea>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" style="border-radius: 0;" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <strong>Soccer/Academic Honors</strong>
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <table class="table">
  <tbody>
    <tr>
      <td><h4><strong>Soccer Honors</strong></h4></td>
      <td></td>
    </tr>
    <tr>
      <td>National Team Roster - U15</td>
      <td></td>
    </tr>
    <tr>
      <td>U.S. Soccer Training Invite</td>
      <td></td>
    </tr>
    <tr>
      <td>ODP Regional Team</td>
        <td></td>
    </tr>
    <tr>
      <td><h4><strong>Academic Honors</strong></h4></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>GPA</strong></td>
      <td>4.0</td>
    </tr>
    <tr>
      <td><strong>SAT Score</strong></td>
      <td>N/A</td>
    </tr>
    <tr>
      <td><strong>ACT Score</strong></td>
      <td>N/A</td>
    </tr>
  </tbody>
</table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" style="border-radius: 0;" id="headingFour">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
          <strong>Articles</strong>
        </button>
      </h2>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body">
          <table class="table">
            <thead>
                <th>Article Name</th>
                <th>Author</th>
                <th>Date</th>
            </thead>
    <tbody>
      <tr>
        <td><a>U15 GNT Game Recap + Standouts <img src="icons/box-arrow-up-right.svg"></img></a></td>
        <td>J.R. Eskilson</td>
        <td>March 9, 2020</td>
      </tr>
      <tr>
        <td><a>U15 GNT to hold first training camp of 2020 <img src="icons/box-arrow-up-right.svg"></img></a></td>
        <td>U.S. Soccer</td>
        <td>March 2, 2020</td>
      </tr>
    </tbody>
  </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" style="border-radius: 0;" id="headingFive">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
          <strong>College</strong>
        </button>
      </h2>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
      <div class="card-body">
        <div class="card-body">
          <table class="table">
            <thead>
                <th>School</th>
                <th>Interest</th>
                <th>Commitment</th>
            </thead>
    <tbody>
      <tr>
        <td>Michigan</td>
        <td>Warm</td>
        <td>N/A</td>
      </tr>
      <tr>
        <td>USC</td>
        <td>Warm</td>
        <td>N/A</td>
      </tr>
      <tr>
        <td>Pepperdine</td>
        <td>Cold</td>
        <td>N/A</td>
      </tr>
    </tbody>
  </table>
        </div>
      </div>
    </div>
  </div>
</div>


  </div>
</div>
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
