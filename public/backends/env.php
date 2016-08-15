<?php
  if(getenv("MODE") !== "PRODUCTION") {
    require(__dir__.'/../../vendor/autoload.php');

    $dotenv = new Dotenv\Dotenv(__DIR__."/../..");
    $dotenv->load();
  }
?>
