<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Submit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  </head>
  <body>

  </body>
</html>




<?php
// (A) CAPTCHA CHECK
$result = "";
require "1-captcha.php";
if (!$PHPCAP->verify($_POST['captcha'])) {
  $result = "CAPTCHA does not match!";
  ?>
  <div  id="jumbotron" class="container-fluid bg-light p-5 ">
      <h1 class="display-4">Oops!!!!</h1>
      <p class="lead">CAPTCHA does not match!</p>
      <hr class="my-4">
      <p>Click here to go back.</p>
      <a class="btn btn-primary btn-lg"  onclick="history.go(-1)" role="button">Back</a>
    </div>

  <?php
}

if ($result == "") {
  $result = "Congrats, CAPTCHA is correct.";
  ?>
  <div  id="jumbotron" class="container-fluid bg-light p-5 ">
        <h1 class="display-4">Congrats!!!!</h1>
        <p class="lead">Congrats, CAPTCHA is correct.</p>
        <hr class="my-4">
        <p>Click here to go back.</p>
        <a class="btn btn-primary btn-lg" href="2-form.php"   role="button">Reload</a>
      </div>

      <?php
}
