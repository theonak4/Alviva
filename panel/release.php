<?php
session_start();
error_reporting(0);

$recordId = $_POST["recordID"];
$_SESSION["recordId_request"] = $recordId;

if($recordId == "") {
  $recordId = $_GET["recordId"];
  $_SESSION["recordId_request"] = $recordId;
}

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
$readyToPlay = 0;

$teamName = "";

if($_SESSION["loggedIn"] == false) {
  header("Location: http://54.188.51.218");
} else {

  $user = $_SESSION["user"];

  $conn = new mysqli("localhost", "root", "", "alviva");
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
      $readyToPlay = $row["readyToPlay"];
      $playerId = $row["id"];
    }
  }

  // Fetch associated team's information
  $getTeamInfo = $conn->query("SELECT * FROM teams WHERE id='{$teamID}'");
  if($getTeamInfo->num_rows > 0) {
    while($row = $getTeamInfo->fetch_assoc()) {
      $teamName = $row["teamName"];
    }
  }

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
  height: 150;
  padding: 50;
  padding-left: 3%;
  padding-top: 30;
}

a {
  color: black;
}

a:hover {
  text-decoration: none;
  color: black;
}

</style>


</head>

<body>
  <h1 style="font-weight: 900; margin-left: 3%; margin-top: 5%">alviva</h1>
  <h4 style="margin-left: 3%">Welcome, <?php echo $userName; ?></h4>
  <hr style="width: 300px; margin-left: 3%">
  <br>
  <h5><img src="icons/person-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> player <?php if(!$readyToPlay) { echo "<span class='badge badge-danger badge-pill'>!</span>"; } ?></h5>
  <br>
  <h5><img src="icons/people-fill.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> team</h5>
  <br>
  <h5><img src="icons/box-arrow-in-right.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> <strong>access requests</strong></h5>
  <br>
  <h5><img src="icons/book-half.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> access history</h5>
  <br>
  <a href="http://54.188.51.218/account/logout.php"><button type="button" class="btn btn-outline-danger" style="width: 300px; font-weight: 800; border-radius: 0; margin-left: 3%">log out</button></a>
  <div style="position: fixed; width: 50%; height: 100%; top: 6%; left: 20%">
    <h2 style="margin-top: 5%">information authorization request</h2>

    <hr style="width: 700; float: left">
    <br>
    <br>
    <div class="list-group" style="width: 700">

      <?php

      $recipient = "";
      $accessRecords = $conn->query("SELECT * FROM accessrecords WHERE recordId='{$recordId}' ORDER BY date DESC LIMIT 2");
      if($accessRecords->num_rows > 0) {
        while($row = $accessRecords->fetch_assoc()) { $recipient = $row["recipientName"]; ?>

          <span class="list-group-item" style="border: 0; text-align: left; padding: 0;">
            <div class="d-flex w-100 justify-content-between">
              <h2 class="mb-1" style="font-weight: 600"><?php echo $row["recipientName"] ?></h2>
              <h6><?php echo date("F jS, Y", strtotime($row["date"])) ?></h6>
            </div>
            <p class="mb-1"><?php echo $row["reason"] ?></p>
            <br>
            <span><i>you agree to share <?php echo $playerFirst; ?>'s:</i></span><br>
            <span><?php if($row["d1"]) { echo "- Birth Certificate<br>"; }?></span>
            <span><?php if($row["d2"]) { echo "- Youth Player Registration Form<br>"; }?></span>
            <span><?php if($row["d3"]) { echo "- Player Card"; }?></span><br><br>
         </span>

        <?php
      }
    } else { ?>

      <div class="card" style="width: 600; border-radius:0; text-align: center">
        <div class="card-body">
          <strong>Error!</strong> Request not found. <a href="http://54.188.51.218/panel">Retrun to Home</a>
        </div>
      </div>

     <?php  }

      ?>
      <span style="text-align: left">with <span class="badge badge-pill badge-warning" style="font-weight: 600; font-size: 15; padding: 10"><?php echo $recipient; ?></span></span><br>
      <span style="text-align: left;">
      <br>

      <form action="authorizeRelease.php" method="POST">

      <div class="form-group" style="width: 100%; text-align: left"> <!-- PASSWORD -->
        <label for="formGroupExampleInput" style="font-weight: 600">enter your password to confirm</label>
        <input type="password" class="form-control" name="password" style="border-radius: 0; font-weight: 800; border-color:  <?php if($incorrect) { echo '#ff6666;'; } ?>" placeholder="">
      </div>
      <button type="submit" class="btn btn-success btn-lg btn-block" style="border-radius: 0; width: 100%; font-weight: 600;">confirm authorization</button>
      <a href="http://54.188.51.218/panel"><button type="button" class="btn btn-light btn-lg btn-block" style="border-radius: 0; width: 100%; font-weight: 600; margin-top: 10">cancel</button></a>
    </form>
    </span>


    </div>




  <div class="footer">
  </div>
</body>
