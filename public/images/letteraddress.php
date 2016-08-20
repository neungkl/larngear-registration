<?php

  require('../backends/env.php');
  require('../backends/connect.php');
  require('../backends/token.php');

  $token = new Token(getenv('TOKEN'));

  if(isset($_GET['pid']) && isset($_GET['token']) && $token->check($_GET['pid'], $_GET['token'])) {
    $code = $conn->query("SELECT code FROM student WHERE personalID=\"{$_GET['pid']}\"");
    $code = $code->fetch_assoc();
    $code = $code['code'];

    header('Content-Type: image/png');

    $img = imagecreate(630, 437);
    
    imagepng($img);
    imagedestroy($img);
  } else {
    echo 'Permission Denied';
  }

?>
