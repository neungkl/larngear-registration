<?php
  require(__dir__.'/env.php');

  $conn = null;

  function connect() {
    global $conn;

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $conn = new mysqli($server, $username, $password, $db);
    mysqli_set_charset($conn,"utf8");
  }

  connect();
?>
