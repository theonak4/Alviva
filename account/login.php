<?php
error_reporting(0);
$incorrect = false;
if($_GET["fail"] == true) {
  $incorrect = true;
}


 ?>

 <head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Merriweather:wght@700&family=Montserrat:wght@300;400;800;900&display=swap" rel="stylesheet">
<link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
<title>alviva | Access your account</title>
   <style>
   body, html {
     padding: 0;
     margin: 0;
     margin-left: 0%;
     font-family: "DM Sans";

   }

   h3 {
   }

   .box {
     position: absolute;
     left: 7%;
     top: 18%;
     width: 650;
     height: 690;
     background: linear-gradient(to bottom right, white, white, white, white, #4A86E8);
   }

   .footer {
     background: black;
     width: 100%;
     padding: 20;
     color: white;
     font-weight: 800;
     position: absolute;
     bottom: 0;
   }



   </style>

 </head>

 <body>
   <div class="box">
   <img src="logotype_t.png" style="width: 150; margin-left: 5%"></img>
   <h3 style="font-weight: 300; margin-left: 5%">access your account</h3>
   <br>
   <br>
   <form action="http://54.188.51.218/account/authenticate.php" method="POST">

   <div class="form-group" style="margin-left: 5%; width: 500"> <!-- EMAIL -->
    <label for="formGroupExampleInput" ><strong>email </label>
    <input type="text" class="form-control" name="email" style="border-radius: 0; font-weight: 800; background: transparent;" placeholder="">
   </div>

   <div class="form-group" style="margin-left: 5%; width: 500"> <!-- PASSWORD -->
     <label for="formGroupExampleInput" ><strong>password </strong></label>
     <input type="password" class="form-control" name="password" style="border-radius: 0; font-weight: 800; background: transparent;" placeholder="">
   </div>

   <br>
   <button type="submit" class="btn btn-primary" style="margin-left: 5%; font-weight: 700; border-radius: 0; width: 200; background: linear-gradient(to right, #4A86E8, #1C4587);">login</button><br><br>
   <a href="forgot.php" style="font-weight: 600; margin-left: 5%; margin-top: 5%; color: #4A86E8">Trouble logging in? </a>
     </form>
   <br><br><br>
   <div class="alert alert-warning" role="alert" style="border-radius: 0; width: 350; margin-left: 5%; visibility: <?php if($incorrect) { echo ''; } else { echo 'hidden';}?>; background: rgba(74, 134, 232, 0.5); border: 0; border-left: 5px solid #4A86E8;">
     <strong style="color: black;"><img src="icons/exclamation-circle.svg" width="25" height="25" style="margin-right: 5;"> incorrect email or password</strong>
   </div>
   <br><br><br>
   <a href="http://54.188.51.218">
   <div class="footer">
     <img src="icons/chevron-double-left.svg" width="25" height="25" style="margin-right: 2; filter: invert(100%)"> return to homepage
   </div>
 </a>
 </div>
 </body>
