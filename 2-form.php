<?php


 ?>



<!DOCTYPE html>
<html>
  <head>
    <title>PHP Captcha Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
    #demo {
      max-width: 600px;
      padding: 15px;
      background: #f2f2f2;
      margin-left: auto;
      margin-right: auto;
      margin-top: 0%;
    }
    #demo label, #demo input {
      display: block;
      box-sizing: border-box;
      width: 100%;

      padding: 10px;
    }
    #demo1{
      text-align: right;
      color: red;
      font-size: 1.5rem;
    }
    </style>
  </head>
  <body>
    <form id="demo" class="form-group" method="post" action="3-submit.php">
<h3 class="text-center">Form</h3>
      <div class="row">
        <div class="col-md-6">
          <label class="col-form-label" for="name">Name:</label>
          <input class="form-control" name="name" type="text" placeholder="Enter Your Name."  />
        </div>
        <div class="col-md-6">
          <label class="col-form-label" for="email">Email:</label>
          <input class="form-control" name="email" type="email" placeholder="Enter Your Email."  />
        </div>
        <div class="col-md-6">
          <label class="col-form-label" for="name">Date of birth:</label>
          <input max="<?= date('Y-m-d'); ?>" class="form-control" name="name" type="date"  />
        </div>


      </div>
      <label class="col-form-label" for="name">About Yourself:</label>
      <textarea class="form-control" name="name" rows="5" placeholder="Tell us a little about yourself." ></textarea>





      <label class="col-form-label" for="captcha">Are you human?</label>
      <?php
      require "1-captcha.php";
      $PHPCAP->prime();
      $PHPCAP->draw();
      ?>
      <input style="width:50%;" name="captcha" class="form-control mt-2" type="text" placeholder="Enter captcha"  />

      <p class="mb-0" id="demo1">3m 0s</p>

      <input type="submit" class="btn btn-primary mt-0" value="submit"/>
    </form>
    <div style="display:none;" id="jumbotron" class="container-fluid bg-light p-5 ">
    	  <h1 class="display-4">Oops!!!!</h1>
    	  <p class="lead">Timed out.</p>
    	  <hr class="my-4">
    	  <p>Click here to try again.</p>
    	  <a class="btn btn-primary btn-lg" href="2-form.php" role="button">Reload</a>
    	</div>
    <script>
  // Set the date we're counting down to
  var countDownDate = new Date().getTime()+180000;

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds

    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("demo1").innerHTML =minutes + "m " + seconds + "s ";

    // If the count down is over, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").style.display = "none";
      document.getElementById("jumbotron").style.display = "block";
    }
  }, 1000);
  </script>

  </body>
</html>
