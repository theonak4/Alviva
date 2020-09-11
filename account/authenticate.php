<?php

session_start();

$DB_HOST = "#########";
$DB_USER = "####";
$DB_PASS = "#######$";
$DB_NAME = "######";

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if( mysqli_connect_errno() ) {
  header("Location: http://54.188.51.218/?db_down=true");
}

if(isset($_GET["user"])) {
  if($_GET["user"] == "parent") {
    session_regenerate_id();
    $_SESSION["loggedIn"] = true;
    $_SESSION["user"] = "tdnakfoor@gmail.com";
    $_SESSION["userID"] = 0;
    header("Location: http://54.188.51.218/panel");
  } elseif($_GET["user"] == "manager") {
    session_regenerate_id();
    $_SESSION["loggedIn"] = true;
    $_SESSION["user"] = "examplemanager@gmail.com";
    $_SESSION["userID"] = 2;
    header("Location: http://54.188.51.218/managerpanel");
  } elseif($_GET["user"] == "ref") {
    session_regenerate_id();
    $_SESSION["loggedIn"] = true;
    $_SESSION["user"] = "exampleref@gmail.com";
    $_SESSION["userID"] = 3;
    header("Location: http://54.188.51.218/refreepanel");
  } elseif($_GET["user"] == "org") {
    session_regenerate_id();
    $_SESSION["loggedIn"] = true;
    $_SESSION["user"] = "exampleorg@gmail.com";
    $_SESSION["userID"] = 4;
    header("Location: http://54.188.51.218/organizerpanel");
  }
} else {
if ( !isset($_POST["email"], $_POST["password"]) ) {
  header("Location: http://54.188.51.218/account/login.php?fail=true");
}

if($stmt = $conn->prepare("SELECT id,password,type FROM users WHERE email = ?")) {
  $stmt->bind_param('s', $_POST["email"]);
  $stmt->execute();

  $stmt->store_result();
  if($stmt->num_rows > 0) {
    $stmt->bind_result($id, $password, $type);
    $stmt->fetch();

    if($_POST["password"] === $password) {
      session_regenerate_id();
      $_SESSION["loggedIn"] = true;
      $_SESSION["user"] = $_POST["email"];
      $_SESSION["userID"] = $id;

      echo "successful login";
      echo $type;
      if($type == "manager") {
      header("Location: http://54.188.51.218/managerpanel");
    } elseif($type == "refree") {
      header("Location: http://54.188.51.218/refreepanel");
    } elseif($type == "organizer") {
      header("Location: http://54.188.51.218/organizerpanel");
    } else {
      header("Location: http://54.188.51.218/panel");
      }

    } else {
    echo "incorrect pass";
    header("Location: http://54.188.51.218/account/login.php?fail=true");
    }

  } else {
    echo "incorrect user";
    header("Location: http://54.188.51.218/account/login.php?fail=true");
  }

  $stmt->close();
}
}
 ?>
