<?php

 ?>

 <head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500i,600,600i,700i,800,800i,900&display=swap" rel="stylesheet">
   <title>Alviva | Secure player information storage</title>
   <style>
   body, html {
     padding: 0;
     margin: 0;
     margin-left: 0%;
     font-family: "Montserrat";
     color: black;
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


   .hl {
     background-image: linear-gradient(transparent 60%, #00802b 55%);
     display: inline;
   }

   .slash {
     background: linear-gradient(to top left, transparent 0%, transparent 60%, #66ff99 40%, #009933 100%);
     width: 100%;
     height: 1100px;
     position: absolute;
     top: 0;
     left: 0;
     z-index: 3;
   }

   .topbar {
     position: absolute;
     top: 0;
     left: 0;
     background: black;
     width: 100%;
     padding: 30;
     z-index: 2;
     text-align: right;
     color: white;
     font-size: 20;
   }

   .underbar {
     position: absolute;
     top: 89;
     left: 0;
     background: #009933;
     font-weight: 600;

     text-align: right;
     width: 100%;
     padding: 8;
     padding-right: 30;
     z-index: 2;
   }

   .underbarLink {
     position: absolute;
     top: 89;
     right: 0;
     background: transparent;
     width: 30%;
     height: 47;
     padding-right: 30;
     z-index: 4;
   }


   </style>

 </head>

 <body>
   <div class="slash">
   <h1 style="font-weight: 900; position: absolute; left: 3%; top: 6%; font-size: 50" class="logo">alviva</h1>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <h1 style="font-weight: 400; margin-left: 3%; margin-top: 4%"><strong>The <span class="hl">new standard</span> for how player<br>information is stored</strong></h1>
   <br>
   <h4 style="margin-left: 3%; font-weight: 400;">Learn how Alviva securely encrypts and stores player<br>data online and can help you say goodbye<br>to tedious paperwork.</h4>
   <br>
   <br>
   <br>
   <div style="position: absolute; right: 700; top: 450; text-align: right;">
     <h6><strong><img src="icons/layers.svg" width="25" height="25" style="margin-right: 5"> CONTROL YOUR DATA</strong></h6>
     <h3><strong>intelligent data control</strong></h3>
     <h5>aliva allows you to view and regulate who has<br> access to your child's information</h5>
     <br>
     <button type="button" class="btn btn-outline-success" style="border-radius: 0; font-weight: 600; width: 300">tell me more</button>
   </div>
   <img src="request.png" style="width: 600; position: absolute; right: 80; top: 380; border-bottom: 3px solid black;"></img>
   <img src="scroll.gif" id="scroll" style="width:100; margin-top: 20%; margin-left: 30%"></img>
   <br><br><br><br><br><br><br><br><br><br>

   <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 </div>
 <div class="topbar">
   <a><strong>learn more</strong></a> <a style="margin-left: 20"><strong>support</strong></a> </a>
 </div>

 <div class="underbar">
   access your account <img src="icons/chevron-double-right.svg" width="25" height="25">
 </div>

 <a href="http://localhost/alviva/account/login.php">
 <div class="underbarLink">
 </div>
</a>

<!--<img src="iphone.png" style="position: fixed; bottom: 150; right: 25%; width: 600"></img>-->
