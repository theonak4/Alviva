<?php
?>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500i,600,600i,700i,800,800i,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
<link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
<title>alviva | Secure player data storage</title>
<style>
body::-webkit-scrollbar {
  display: none;
}
.logo {
  position: absolute;
  left: 100;
  top: 100;
  width: 170;
  font-family: "Montserrat";
}

.hl {
  background-image: linear-gradient(transparent 60%, rgba(74, 134, 232, 0.5) 55%);
  display: inline;
}


.landing {
  background: linear-gradient(to top left, white, white, #4A86E8);
}

.navbar {
  position: absolute;
  right: 100;
  top: 87;
  font-size: 22;
  color: black;
}

.login {
  width: 600;
  height: 650;
  position: absolute;
  background: white;
  border: 1px solid #f1f1f1;
  border-radius: 5px;
  padding: 30;
  right: 350;
  top: 260;
  font-family: 'DM Sans';
  border-bottom: 0;
  box-shadow: -3px 10px 17px -6px rgba(0,0,0,0.75);
}

*:focus {
    outline: none !important;
}

.scrolldown {
  color: black;
  position: absolute;
  left: 420;
  top: 850;
  font-family: "DM Sans";
}

.scrolldownicon {
  animation: scroll 3s linear infinite;
}

.footer {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 30px;
  background: #f1f1f1;
  width: 100%;
  height: 50;
}

@keyframes scroll {
  0%, 100% {
    margin-top: 0;
  }
  50% {
    margin-top: 8px;
  }
}

textarea:focus,
input[type="text"]:focus,
input[type="password"]:focus,
input[type="datetime"]:focus,
input[type="datetime-local"]:focus,
input[type="date"]:focus,
input[type="month"]:focus,
input[type="time"]:focus,
input[type="week"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="search"]:focus,
input[type="tel"]:focus,
input[type="color"]:focus,
.uneditable-input:focus {
  border-bottom: 2px solid #4A86E8;
  outline: 0 none;
  box-shadow: none;
}


</style>

<script>
function setLanding() {
  height = window.innerHeight;
  width = window.innerWidth;
  document.getElementById("landing").style.width = width;
  document.getElementById("landing").style.height = height;

  var app = document.getElementById('hl');

  var typewriter = new Typewriter(app, {
      loop: true
  });

  typewriter.typeString('new standard')
      .pauseFor(10000)
      .deleteAll()
      .typeString('safer alternative')
      .pauseFor(10000)
      .deleteAll()
      .typeString('easiest solution')
      .pauseFor(10000)
      .start();

}



</script>

</head>
<body onload="setLanding()">
  <div class="landing" id="landing">
  <div class="navbar">
    <a><strong>product</strong></a> <a><strong style="margin-left: 25">learn more</strong></a> <a style="margin-left: 25"><strong>support</strong></a> </a>
  </div>
  <img src="logotype_t.png" class="logo"></img><br><br><br><br><br><br><br><br><br>
  <h1 style="margin-top: 5%; font-weight: 700; font-family: 'DM Serif Text'; font-size: 50; color: black; margin-left: 100;">
    The <span class="hl" id="hl">new standard</span> for how player<br>information is stored.</h1>
  <br>
  <h4 style="font-weight: 400; font-size: 28; margin-left: 100; font-family: 'DM Sans'">Learn how <strong style="font-family: 'Montserrat'">alviva</strong> securely encrypts and stores player data <br>online and can help you say goodbye to tedious<br>paperwork</h4>
  <br>
  <br>
  <button type="button" class="btn btn-primary" style="border-radius: 0; width: 240; margin-left: 100;">for <span style="font-family: 'DM Serif Text'">parents</span></button>
  <button type="button" class="btn btn-primary" style="border-radius: 0; width: 240;">for  <span style="font-family: 'DM Serif Text'">coaches</span></button>
  <button type="button" class="btn btn-outline-primary" style="border-radius: 0; width: 240;">for <span style="font-family: 'DM Serif Text'">organizations</span></button>

  <div class="scrolldown">
    <center>
    <strong>scroll down</strong><br>
    <img class="scrolldownicon" src="icons/chevron-compact-down.svg" width=50></img>
    </center>
  </div>

  <div class="login">
    <small style="font-size: 15;"><img src="icons/people-fill.svg" width=25 style="margin-bottom: 3; margin-right: 10;"></img> PRE-REGISTERED USERS</small>
    <h1 style="margin: 0; padding: 0;"><strong>access your account</strong></h1>
    <br><br>
    <form action="http://54.188.51.218/account/authenticate.php" method="POST">
      <div class="form-group">
        <label for="exampleInputEmail1">E-mail Address</label>
        <input style="font-weight: 600; border-left: 0; border-top: 0; border-right: 0; border-radius: 0;" type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your Email">
      </div>
      <div class="form-group" style="margin-top: 20;">
        <label for="exampleInputPassword1">Password</label>
        <input style="font-weight: 600; border-left: 0; border-top: 0; border-right: 0; border-radius: 0;" type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Your Password">
      </div>
      <br><br><br><br><br><br>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1"><strong>Remember me</strong> <small>(Only use on personal computers)</small></label>
      </div>
      <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 18; background: linear-gradient(to right, #4A86E8, #1C4587);"><strong>log in</strong></button>
    </form>

    <div style="background: #f1f1f1; width: 100%; height: 50; position: absolute; bottom: 0; left: 0; padding: 14; padding-left: 30; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
      <strong>Don't have an account?</strong> Sign up for free <img src="icons/chevron-double-right.svg" width="20" style="margin-bottom: 2; float: right;"></img>
    </div>
  </div>
</div>
<br><br><div style="background: black; width: 100%; padding: 100; padding-left: 0; color: white;">
<h1 style="font-family: 'DM Sans'; margin-left: 5%; font-weight: 700;" class="hl">How It Works</h1>
<p style="font-family: 'DM Sans'; margin-left: 5%; margin-top: 20;">Currently, sports teams rely on physical binders and groups<br>of people to keep tabs on player information.<br><br>With Alviva, you skip the middleman and potential<br>for human error. Our centralized database keeps track<br>of your player's records and allows them to be<br>easily <strong>(and securely)</strong> shared with coaches and<br> tournament organizers.</p>
<button type="button" class="btn btn-outline-dark" style="font-family: 'DM Sans'; border-radius: 0; margin-left: 5%; width: 150; color: white; border-color: white;">learn more</button>
</div>
<img src="diagram_bw.png" style="position: absolute; top: 107%; right: 10%;" width=950></img>
<br><br><br>

<div style="margin-left: 5%">
  <h5 style=" font-weight: 700;">ADVANTAGES</h5>
  <br>
  <div style="width: 1500px;">
 <div style="float: left; width: 32.33%;">

   <div class="card" style="width: 18rem; border-radius: 0; width: 100%;">
  <div class="card-body">
    <h2 class="card-title"><strong>Security</strong></h2>
    <h5 class="card-subtitle mb-2 text-muted">256-Bit Encrypted Data Storage</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>

 </div>
 <div style="float: left; width: 32.33%; margin-left: 20;">

   <div class="card" style="width: 18rem; border-radius: 0; width: 100%;">
  <div class="card-body">
    <h2 class="card-title"><strong>Accessibility</strong></h2>
    <h5 class="card-subtitle mb-2 text-muted">Access on Any Device</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>

 </div>
 <div style="float: left; width: 32.33%; margin-left: 20;">

   <div class="card" style="width: 18rem; border-radius: 0; width: 100%;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>

 </div>
 <br style="clear: left;" />
</div>
</div>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <div style="width: 100%; background: black; height: 100; padding: 40; padding-top: 25; font-family: 'DM Sans'; color: white;">
    <!--<img src="bs_logotye_w.png" style="width: 200; margin: 0; padding: 0;"></img>-->
    <small style="margin: 0; padding: 0;"><strong>&copy; 2020</strong></strong>
  </div>
</body>
