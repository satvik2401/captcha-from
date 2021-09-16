<?php
class Captcha {
  function prime ($length=8) {
    $char = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $max = strlen($char) - 1;
    $random = "";
    for ($i=0; $i<=$length; $i++) {
      $random .= substr($char, rand(0, $max), 1);
    }
    $_SESSION['captcha'] = $random;
  }

  function draw ($output=1, $width=300, $height=100, $fontsize=24, $font="Official.ttf") {
    if (!isset($_SESSION['captcha'])) { throw new Exception("CAPTCHA NOT PRIMED"); }

    $captcha = imagecreatetruecolor($width, $height);

    $background = "captcha-back.jpg";
    list($bx, $by) = getimagesize($background);
    if ($bx-$width<0) { $bx = 0; }
    else { $bx = rand(0, $bx-$width); }
    if ($by-$height<0) { $by = 0; }
    else { $by = rand(0, $by-$height); }
    $background = imagecreatefromjpeg($background);
    imagecopy($captcha, $background, 0, 0, $bx, $by, $width, $height);

    $text_size = imagettfbbox($fontsize, 0, $font, $_SESSION['captcha']);
    $text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
    $text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);

    $centerX = CEIL(($width - $text_width) / 2);
    $centerX = $centerX<0 ? 0 : $centerX;
    $centerX = CEIL(($height - $text_height) / 2);
    $centerY = $centerX<0 ? 0 : $centerX;

    if (rand(0,1)) { $centerX -= rand(0,55); }
    else { $centerX += rand(0,55); }
    $colornow = imagecolorallocate($captcha, rand(120,255), rand(120,255), rand(120,255)); // Random bright color
    imagettftext($captcha, $fontsize, rand(-10,10), $centerX, $centerY, $colornow, $font, $_SESSION['captcha']);

    if ($output==0) {
      header('Content-type: image/png');
      imagejpeg($captcha);
      imagedestroy($captcha);
    }

    else {
      ob_start();
      imagejpeg($captcha);
      $ob = base64_encode(ob_get_clean());
      echo "<img src='data:image/jpeg;base64,$ob'/>";
    }
  }

  function verify ($check) {
    if (!isset($_SESSION['captcha'])) { throw new Exception("CAPTCHA NOT PRIMED"); }

    if ($check == $_SESSION['captcha']) {
      unset($_SESSION['captcha']);
      return true;
    } else {
      return false;
    }
  }
}

session_start(); 
$PHPCAP = new Captcha();
