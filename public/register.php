<?php

  if($_SERVER['REQUEST_METHOD'] === "POST") {
    if($_POST['q'] == "register") {
      die('{"success":false, "msg":"end"}');

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

        $resp = $validator->check($val, $key);

        if($resp['success'] === "false") {
          reject('{"success":false, "msg":"Incorrect data"}');
        }

        array_push($keys, $key);
        array_push($vals, $val);
      }

      function addDoubleQuote($val) {
        global $conn;
        return "\"".$conn->real_escape_string($val)."\"";
      }

      $keys = join(",", $keys);
      $vals = join(",", array_map("addDoubleQuote", $vals));

      $result = $conn->query("INSERT INTO student($keys) VALUES ($vals)");

      // Pass all validation test
      if($result) {

        require('backends/gencode.php');

        $gen = new GenCode($conn);
        $type = "-";

        $centerList = array(
          'กรุงเทพมหานคร',
          'นนทบุรี',
          'ปทุมธานี',
          'สมุทรปราการ',
          'สมุทรสาคร',
          'นครปฐม'
        );

        if($_POST['form']['prefix'] == "master" || $_POST['form']['prefix'] == "mr") {
          if(in_array($_POST['form']['province'], $centerList)) $type = "A";
          else $type = "B";
        } else {
          if(in_array($_POST['form']['province'], $centerList)) $type = "C";
          else $type = "D";
        }

        if($gen->generate($_POST['form']['personalID'], $type) == "pass") {

          require('backends/token.php');
          require('backends/env.php');

          $token = new Token(getenv('TOKEN'));
          $token = $token->hash($_POST['form']['personalID']);

          reject('{"success":true, "token": "'.$token.'"}');
        }
        else {
          $conn->query("DELETE FROM student WHERE personalID=\"{$_POST['form']['personalID']}\"");
          reject('{"success":false, "msg":"Generate code fail"}');
        }
      }

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
