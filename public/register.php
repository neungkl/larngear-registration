<?php

  if($_SERVER['REQUEST_METHOD'] === "POST") {
    if($_POST['q'] == "register") {
      require('backends/connect.php');
      require('backends/validation.php');

      function reject($txt) {
        global $conn;
        $conn->close();
        die($txt);
      }

      $registerFormat = file_get_contents(__dir__.'/src/registerFormat.json');
      $registerFormat = json_decode($registerFormat, true);

      $validator = new Validation($registerFormat);

      $requireF = $validator->getRequireField();

      for($i=0; $i<count($requireF); $i++) {
        if(!isset($_POST['form'][$requireF[$i]]))
          reject('{"success":false, "msg":"Require field"}');
      }

      $keys = [];
      $vals = [];

      foreach($_POST['form'] as $key => $val) {
        $resp = $validator->check($key, $val);

        array_push($keys, $key);
        array_push($vals, $val);

        if(!$resp['success']) {
          reject('{"success":false, "msg":"Incorrect data"}');
        }

      }

      function addDoubleQuote($val) {
        global $conn;
        return "\"".$conn->real_escape_string($val)."\"";
      }

      $keys = join(",", $keys);
      $vals = join(",", array_map("addDoubleQuote", $vals));

      $result = $conn->query("INSERT INTO student($keys) VALUES ($vals)");
      if($result) reject('{"success":true}');

      reject('{"success":false, "msg":"Insert errror"}');

    }
    else if($_POST['q'] == "personalCheck") {
      require('backends/connect.php');

      $result = $conn->query("SELECT personalID FROM student WHERE personalID = {$_POST['pid']}");

      if($result && ((int) mysqli_num_rows($result)) > 0) die('{"status":"duplicate"}');

      $conn->close();
      die('{"status":"available"}');
    }
    else {
      die('{"success":false, "msg":"Query not match"}');
    }

  } else {
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);
    die('404 Not Found');
  }

?>
