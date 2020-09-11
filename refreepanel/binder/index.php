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


</style>


</head>

<body>
  <h1 style="font-weight: 900; margin-left: 3%; margin-top: 5%">alviva</h1>
  <h4 style="margin-left: 3%">Welcome, <?php echo $userName; ?></h4>
  <hr style="width: 300px; margin-left: 3%">
  <br>
  <a href="http://54.188.51.218/refreepanel/" style="color: black"><h5><img src="icons/person-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> <strong>your profile</strong></h5></a>
  <br>
  <a href="http://54.188.51.218/account/logout.php"><button type="button" class="btn btn-outline-danger" style="width: 300px; font-weight: 800; border-radius: 0; margin-left: 3%">log out</button></a>
  <div style="position: fixed; width: 58%; height: 100%; top: 5%; left: 425px;">
    <h1 style="margin-top: 5%">Blues Cup</h1>
    <br>
    <div class="media" style="background: #fafafa; padding: 20; width: 600;">
        <div class="media-body">
          EVENT INFORMATION
          <h5 class="mt-0" style="font-weight: 800; margin-bottom: 0; padding-bottom: 0;">SoCal Blues, Lincoln '07 v. SD Surf, Reagan '07</h5>
          <h6>Oceanside Complex, Field 18</h6>

        </div>
    </div>
    <br>
    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#staticBackdrop" style='border-radius: 0; width: 635; float: right; height: 87;'><strong>view all player cards</strong></button>
    <div class="media media-dark" style="background: #d6ecf3; padding: 20; width: 600;">
        <div class="media-body">
          DISPLAYING INFORMATION FOR
          <h5 class="mt-0" style="font-weight: 800; margin-bottom: 0; padding-bottom: 0;">SoCal Blues, Lincoln '07</h5>
        </div>
    </div>
    <br>


    <br>
    <table class="table"  style="width: 1700;">
  <thead class="thead-dark">
    <tr>
      <th colspan=5><center>Player Data</center></th>
      <th></th>
      <th colspan=5><center>Information Status</center></th>
    </tr>
    <tr>
      <th>Player #</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Parent</th>
      <th>Type</th>
      <th>Penalties</th>
      <th  >Birth Certificate</th>
      <th  >Registration</th>
      <th  >Player Card</th>
      <th  >Insurance Waiver</th>
      <th  >COIVD-19 Waiver</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><a data-toggle="modal" data-target="#exampleModal" href=" ">1</a></th>
      <td>Ava</a></td>
      <td>Johnson</a></td>
      <td>Tom Johnson</td>
      <td>Permanent</td>
      <td><a href="http://54.188.51.218/refreepanel/viewpenalties">View Penalties</a></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Amy</td>
      <td>Thornton</td>
      <td>Todd Thornton</td>
      <td>Permanent</td>
      <td><a>View Penalties</a></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
       <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
       <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
       <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
       <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Carly</td>
      <td>White</td>
      <td>John White</td>
      <td>Permanent</td>
      <td><a>View Penalties</a></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>Laney</td>
      <td>Smith</td>
      <td>Shawn Smith</td>
      <td>Permanent</td>
      <td><a>View Penalties</a></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td>Martha</td>
      <td>Washington</td>
      <td>George Washington</td>
      <td>Permanent</td>
      <td><a>View Penalties</a></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td>Abigail</td>
      <td>Adams</td>
      <td>Tom Adams</td>
      <td>Permanent</td>
      <td><a>View Penalties</a></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>
    <tr>
      <th scope="row">7</th>
      <td>Dolley</td>
      <td>Madison</td>
      <td>James Madison</td>
      <td>Permanent</td>
      <td><a>View Penalties</a></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>
    <tr>
      <th scope="row">8</th>
      <td>Elizabeth</td>
      <td>Monroe</td>
      <td>Sam Monroe</td>
      <td>Permanent</td>
      <td><a>View Penalties</a></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>
    <tr>
      <th scope="row">9</th>
      <td>Rachel</td>
      <td>Jackson</td>
      <td>Samuel Jackson</td>
      <td>Permanent</td>
      <td><a>View Penalties</a></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>
    <tr>
      <th scope="row">10</th>
      <td>Sarah</td>
      <td>Polk</td>
      <td>John Polk</td>
      <td>Permanent</td>
      <td><a>View Penalties</a></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>
    <tr>
      <th scope="row" class="table-warning">11</th>
      <td class="table-warning">Julia</td>
      <td class="table-warning">Grant</td>
      <td class="table-warning">Tyler Grant</td>
      <td class="table-warning">Guest</td>
      <td class="table-warning">View Penalties</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
    </tr>



  </tbody>
</table>

  </div>

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="width: 1000px; right: 200px;">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel"><strong>all player cards</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img src="card1.jpg"></img><br>
            <img src="card3.jpg"></img><br>
            <img src="card4.jpg"></img><br>
            Player Card 4<br>
            Player Card 5<br>
            Player Card 6<br>
            Player Card 7<br>
            Player Card 8<br>
            Player Card 9<br>
            Player Card 10<br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0;">close</button>
          </div>
        </div>
      </div>
    </div>


  </div>


</body>
