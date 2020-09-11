<?php
session_start();
error_reporting(0);

$page = $_GET["page"];
$aheadIndex = $page*2;
$previousDisplay = "";
$nextDisplay = "";
$pageDisplay = "";

if($page == "" || $page == null || $page < 0) {
  header("Location: http://54.188.51.218/panel/history/?page=0");
} else if($page == 0) {
  $previousDisplay = "none";
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

  $getAccepted = $conn->query("SELECT * FROM accessrecords WHERE playerId={$playerId} AND authorized=1");
  $numAccepted = $getAccepted->num_rows;

  if($numAccepted%2 == 0) {
  $allowedPages = floor($numAccepted/2)-1;
  } else {
  $allowedPages = floor($numAccepted/2);
  }

  if($page >= $allowedPages) {
    $nextDisplay = "none";
  } else if($numAccepted == 0) { $nextDisplay = "none"; };

  $getAR = $conn->query("SELECT * FROM accessrecords WHERE playerId={$playerId} AND authorized=0");
  $arNotifs = $getAR->num_rows;

  if($numAccepted == 0) {
    $pageDisplay = "none";
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
  height: 5%;
  padding-left: 3%;
  padding-top: 30;
}

a {
  color: black;
}

a:hover {
  color: black;
  text-decoration: none;
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
  <h5><img src="icons/book-half.svg" alt="" width="36" height="36" style="margin-right: 10px; margin-left: 3%;"> <strong>access history</strong></h5>
  <br>
  <a href="http://54.188.51.218/account/logout.php"><button type="button" class="btn btn-outline-danger" style="width: 300px; font-weight: 800; border-radius: 0; margin-left: 3%">log out</button></a>
  <div style="position: fixed; width: 50%; height: 100%; top: 5%; left: 425px;">
    <h1 style="margin-top: 5%; margin-bottom: 20">Access History</h1>
    <?php
    $accessRecords = $conn->query("SELECT * FROM accessrecords WHERE playerId='{$playerId}' AND authorized=1 ORDER BY dateAuthorized DESC LIMIT 2 OFFSET {$aheadIndex}");
    if($accessRecords->num_rows > 0) {
      while($row = $accessRecords->fetch_assoc()) {
          ?>

        <span href="#" class="list-group-item">
          <div class="d-flex w-100 justify-content-between">
            <h3 class="mb-1" style="font-weight: 600;"><?php echo $row["recipientName"] ?></h3>
            <a>contact requester <img src="icons/envelope.svg" width="20" height="20" style="margin-left: 5;"></img></a>
          </div>
          <hr style="margin: 0; padding: 0; margin-bottom: 10">
          <ul class="list-group list-group-horizontal-lg">
            <li class="list-group-item" style="border: 0; padding: 0;"><small style="font-weight: 600">date requested <h4 style="font-weight: 500"><?php echo date("F jS, Y", strtotime($row["date"])) ?></h4></small></li>
            <li class="list-group-item" style="border: 0; padding: 0; margin-left: 30"><small style="font-weight: 600">date authorized <h4 style="font-weight: 500"><?php echo date("F jS, Y", strtotime($row["dateAuthorized"])) ?></h4></small></li>
          </ul>
          <br>
          <small style="font-weight: 600">reason</small>
          <h5><?php echo $row["reason"]; ?></h5>
          <br>
          <small style="font-weight: 600">information shared</small>

          <ul class="list-group list-group-horizontal" style="margin-top: 5;">
            <li class="list-group-item <?php if($row["d1"]) { echo 'list-group-item-success'; } else { echo 'list-group-item-light'; } ?>" style="border-radius: 0;">Birth Certificates</li>
            <li class="list-group-item <?php if($row["d2"]) { echo 'list-group-item-success'; } else { echo 'list-group-item-light'; } ?>" style="border-radius: 0;">CalSouth Registration Forms</li>
            <li class="list-group-item <?php if($row["d3"]) { echo 'list-group-item-success'; } else { echo 'list-group-item-light'; } ?>" style="border-radius: 0;">Player Cards</li>
          </ul>

          <br>

          <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 0;">
      <img src="icons/check-all.svg" width="20"></img> You're all set
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

       </span><br>



      <?php
    }
  } else {
    ?>

    <br>
    <div class="card" style="width: 600; border:0; text-align: center">
      <div class="card-body" style="padding: 0;">
        <img src="icons/inbox.svg" width="50" height="50"></img><br>
        <strong>Nothing to see here.</strong><br>
        You have not yet authorized any requests
        <br>
        <br>
        <a href="http://54.188.51.218/panel"><button type="button" class="btn btn-primary btn-lg btn-block" style="font-size: 15; font-weight: 600; border-radius:0;">back to home</button></a>
      </div>
    </div>

    <?php
  }
  ?>
  <div class="btn-group">
  <a href="http://54.188.51.218/panel/history/?page=<?php echo $page-1; ?>" ><button type="button" class="btn btn-light" style="border-radius: 0; display: <?php echo $previousDisplay; ?>;">previous page</button></a>
  <a href="http://54.188.51.218/panel/history/?page=<?php echo $page+1; ?>"><button type="button" class="btn btn-primary" style="border-radius: 0; display: <?php echo $nextDisplay; ?>;">next page</button></a>
    <h6 style="margin-left: 20; margin-top: 8; display: <?php echo $pageDisplay; ?>;">page <?php echo $page+1; ?>/<?php echo $allowedPages+1; ?> </h6>
</div>

  </div>


  <div class="footer">
  </div>
</body>
