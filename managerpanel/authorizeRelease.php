<?php
session_start();
error_reporting(0);

$recordId = $_SESSION["recordId_request"];
$password = $_POST["password"];

if($_SESSION["loggedIn"] == false) {
  header("Location: http://localhost/alviva");
} else {

  $user = $_SESSION["user"];

  $conn = new mysqli("localhost", "root", "", "alviva");
  if($conn->connect_error) {
    header("Location: http://localhost/alviva");
  }

  $res = $conn->query("SELECT * FROM users WHERE email='{$user}' AND password='{$password}'");

  if($res->num_rows > 0) {

    $currentDate = date("Y-m-d");
    $conn->query("UPDATE accessrecords SET authorized=1, dateAuthorized='{$currentDate}' WHERE recordId={$recordId}");
    header("Location: http://localhost/alviva/managerpanel?recordAuthorizedSuccess=true");

  } else {
    header("Location: http://localhost/alviva/managerpanel/release.php?recordId={$recordId}");
  }



}

 ?>
