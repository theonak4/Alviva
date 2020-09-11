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
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
  <a href="http://54.188.51.218/managerpanel/" style="color: black"><h5><img src="managericon.png" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> <strong>your team</strong></h5></a>
  <br>
  <a href="http://54.188.51.218/managerpanel/guest" style="color: black"><h5><img src="icons/people-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> guest players</h5></a>
  <br>
  <a href="http://54.188.51.218/managerpanel/requests" style="color: black"><h5><img src="icons/box-arrow-in-right.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> access requests <?php if($getAR->num_rows > 0) { echo "<span class='badge badge-primary badge-pill'>{$arNotifs}</span>"; } ?></h5></a>
  <br>
  <a href="http://54.188.51.218/managerpanel/history" style="color: black"><h5><img src="icons/book-half.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> access history</h5></a>
  <br>
  <a href="http://54.188.51.218/account/logout.php"><button type="button" class="btn btn-outline-danger" style="width: 300px; font-weight: 800; border-radius: 0; margin-left: 3%">log out</button></a>
  <div style="position: fixed; width: 50%; height: 100%; top: 5%; left: 425px;">
    <h1 style="margin-top: 5%">Your Team</h1>
    <br>
    <div class="media" style="background: #fafafa; padding: 20; width: 600">
      <img src="head3shot.jpg" class="mr-3" alt="..." style="width: 60; height: 60; border-radius: 50%">
        <div class="media-body">
          <h4 class="mt-0" style="font-weight: 800; margin-bottom: 0; padding-bottom: 0;">Jane Doe</h4>
          <h4 style="margin: 0;">SoCal Blues, Lincoln '07</h4>
        </div>
    </div>
    <br>
    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#staticBackdrop3" style='border-radius: 0; width: 600;'><strong>view all player cards</strong></button>
    <br>

    <br>
    <table class="table"  style="width: 1700;">
  <thead  style="background: transparent; border: 0;">
    <tr style="background: transparent; border: 0;">
      <th colspan=5 style="border-right: 1px solid #fafafa;"><center>Player Data</center></th>
      <th></th>
      <th colspan=5><center>Information Status</center></th>
      <th></th>
    </tr>
    <tr class="thead-dark">
      <th>Player #</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Parent</th>
      <th>Type</th>
      <th>Date</th>
      <th  >Birth Certificate</th>
      <th  >Youth Player Registration</th>
      <th  >Player Card</th>
      <th  >Insurance Waiver</th>
      <th  >COIVD-19 Waiver</th>
      <th scope="col">Request Info</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">

        <div class="btn-group">
          <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1
          </button>
          <div class="dropdown-menu">
            <ol>
              <a class="dropdown-item" href="#">1</a>
              <a class="dropdown-item" href="#">2</a>
              <a class="dropdown-item" href="#">3</a>
              <a class="dropdown-item" href="#">4</a>
              <a class="dropdown-item" href="#">5</a>
              <a class="dropdown-item" href="#">6</a>
              <a class="dropdown-item" href="#">7</a>
              <a class="dropdown-item" href="#">8</a>
              <a class="dropdown-item" href="#">9</a>
              <a class="dropdown-item" href="#">10</a>
              <a class="dropdown-item" href="#">11</a>
              <a class="dropdown-item" href="#">12</a>
              <a class="dropdown-item" href="#">13</a>
              <a class="dropdown-item" href="#">14</a>
              <a class="dropdown-item" href="#">15</a>
              <a class="dropdown-item" href="#">16</a>
              <a class="dropdown-item" href="#">17</a>
              <a class="dropdown-item" href="#">18</a>
              <a class="dropdown-item" href="#">19</a>
              <a class="dropdown-item" href="#">20</a>
            </ol>
          </div>
        </div>



      </th>
      <td>Ava</a></td>
      <td>Johnson</a></td>
      <td>Tom Johnson</td>
      <td>Permanent</td>
      <td>2019-20</td>
      <td class="table-danger"><a href="http://54.188.51.218/panel/forms/club/bc.png" target="_blank"><center><img src="icons/check-circle.svg" width=20></img></a></center></td>
      <td class="table-danger"><a href="http://54.188.51.218/panel/forms/club/csf.pdf" target="_blank"><center><img src="icons/check-circle.svg" width=20></img></center></a></td>
      <td class="table-success"><a href="http://54.188.51.218/panel/card/card3.jpg" target="_blank"><center><img src="icons/check-circle.svg" width=20></img></center></a></td>
      <td class="table-danger"><a href="http://54.188.51.218/panel/forms/club/csf.pdf" target="_blank"><center><img src="icons/check-circle.svg" width=20></img></center></a></td>
      <td class="table-danger"><a href="http://54.188.51.218/panel/forms/club/covid.pdf" target="_blank"><center><img src="icons/check-circle.svg" width=20></img></center></a></td>
      <td><a href="54.188.51.218/request"  data-toggle="modal" data-target="#staticBackdrop">Request Data</a></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Amy</td>
      <td>Thornton</td>
      <td>Todd Thornton</td>
      <td>Permanent</td>
      <td>2019-20</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
       <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
       <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
       <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
       <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td><a href="54.188.51.218/request">Request Data</a></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Carly</td>
      <td>White</td>
      <td>John White</td>
      <td>Permanent</td>
      <td>2019-20</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td><a href="54.188.51.218/request">Request Data</a></td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>Laney</td>
      <td>Smith</td>
      <td>Shawn Smith</td>
      <td>Permanent</td>
      <td>2019-20</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td><a href="54.188.51.218/request">Request Data</a></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td>Martha</td>
      <td>Washington</td>
      <td>George Washington</td>
      <td>Permanent</td>
      <td>2019-20</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td><a href="54.188.51.218/request">Request Data</a></td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td>Abigail</td>
      <td>Adams</td>
      <td>Tom Adams</td>
      <td>Permanent</td>
      <td>2019-20</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td><a href="54.188.51.218/request">Request Data</a></td>
    </tr>
    <tr>
      <th scope="row">7</th>
      <td>Dolley</td>
      <td>Madison</td>
      <td>James Madison</td>
      <td>Permanent</td>
      <td>2019-20</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td><a href="54.188.51.218/request">Request Data</a></td>
    </tr>
    <tr>
      <th scope="row">8</th>
      <td>Elizabeth</td>
      <td>Monroe</td>
      <td>Sam Monroe</td>
      <td>Permanent</td>
      <td>2019-20</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td><a href="54.188.51.218/request">Request Data</a></td>
    </tr>
    <tr>
      <th scope="row">9</th>
      <td>Rachel</td>
      <td>Jackson</td>
      <td>Samuel Jackson</td>
      <td>Permanent</td>
      <td>2019-20</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td><a href="54.188.51.218/request">Request Data</a></td>
    </tr>
    <tr>
      <th scope="row">10</th>
      <td>Sarah</td>
      <td>Polk</td>
      <td>John Polk</td>
      <td>Permanent</td>
      <td>2019-20</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td><a href="54.188.51.218/request">Request Data</a></td>
    </tr>
    <tr>
      <th scope="row" class="table-warning">11</th>
      <td class="table-warning">Julia</td>
      <td class="table-warning">Grant</td>
      <td class="table-warning">Tyler Grant</td>
      <td class="table-warning">Guest</td>
      <td class="table-warning">Aug 8-Aug 16</td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td class="table-danger"><center><img src="icons/dash-circle.svg" width=20></img></center></td>
      <td class="table-success"><center><img src="icons/check-circle.svg" width=20></img></center></td>
      <td><a href="54.188.51.218/request">Request Data</a></td>
    </tr>



  </tbody>
</table>

<br>

  </div>

  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"><strong>information request</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <strong>To:</strong> Tom Johnson<br>
          <strong>Subject:</strong> Insurance Waiver<br>
          <hr>
          Hi Tom, we still need Ava's insurance waiver, please upload this information.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" style="border-radius: 0;">send request</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="staticBackdrop3" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
  <div class="footer">
    <!--&copy; <strong>blaze</strong>sports-->
  </div>

  <div class="toast" data-autohide="false" style="position: fixed; top: 3%; right: 3%;font-family: Montserrat; border: 0;">
  <div class="toast-header">
    <strong class="mr-auto"><strong>UPCOMING EVENTS</strong></strong>
    <small class="text-muted"></small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">

                  </button>
  </div>
  <div class="toast-body" style="width: 400;">
   <span style="font-size: 16;">Your team is scheduled to participate in <br>the Blues Cup on August 20, 2020.</span><br>
   <a href="">view more <img src="icons/arrow-right-short.svg"></img></a>
  </div>
  <button type="button" class="btn btn-primary" style="border-radius: 0; width: 100%; font-size: 15; "><strong>send team info to registrar <img src="icons/box-arrow-in-right.svg" style="margin-right: 5; filter: invert(100%); width: 20; margin-bottom: 2;"></img></strong></button>
</div>

<script>
$('.toast').toast('show');
</script>


</body>
