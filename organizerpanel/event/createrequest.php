<?php
session_start();
error_reporting(0);

if($_SESSION["loggedIn"] == false) {
  header("Location: http://54.188.51.218");
} else {

  $user = $_SESSION["user"];

  $conn = new mysqli("localhost", "root", "A3xUJk4$", "alviva");
  if($conn->connect_error) {
    header("Location: http://54.188.51.218");
  }

  if($_GET["guidelines-agreement"] != "on") {
    header("Location: http://54.188.51.218/organizerpanel/event");
  }

  $eventName = $_GET["event-name"];
  $startDate = $_GET["event-start"];
  $d1 = $_GET["info1"];
  $d2 = $_GET["info2"];
  $d3 = $_GET["info3"];
  $d4 = $_GET["info4"];
  $d5 = $_GET["info5"];

  if(!isset($d1)) {
    $d1 = 0;
  }

  if(!isset($d2)) {
    $d2 = 0;
  }

  if(!isset($d3)) {
    $d3 = 0;
  }

  if(!isset($d4)) {
    $d4 = 0;
  }

  if(!isset($d5)) {
    $d5 = 0;
  }

  $query = "INSERT INTO accessrecords
            VALUES (2, 0, '{$eventName}', 'Your player is scheduled to participate in this tournament on {$startDate}', {$d1}, {$d2}, {$d3}, '{$startDate}', 0, null, {$d4}, {$d5});";
  echo $query;
  $conn->query($query);
  header("Location: http://54.188.51.218/organizerpanel/?eventcreated=true");

  #$getUserInfo = $conn->query("SELECT * FROM users WHERE email='{$user}'");
}
 ?>
