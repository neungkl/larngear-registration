<?php
  if($_SERVER['REQUEST_METHOD'] === "POST") {
    if(!isset($_POST['personalID']) || !isset($_POST['name']) || !isset($_POST['surname'])) {
      die('{"success":false, "msg":"INVALID"}');
    }

    if(strlen($_POST['name']) > 30 || strlen($_POST['surname']) > 30) {
      die('{"success":false, "msg":"INVALID"}');
    }

    require(__dir__.'/connect.php');

    $_POST['personalID'] = $conn->real_escape_string($_POST['personalID']);

    $result = $conn->query("SELECT personalID,name,surname FROM student WHERE personalID=\"{$_POST['personalID']}\"");
    if(mysqli_num_rows($result) > 0) {

      $result = $result->fetch_assoc();

      function LCS_Length($s1, $s2)
      {
        $m = strlen($s1);
        $n = strlen($s2);

        $LCS_Length_Table = array();
        for($i=0; $i <= $m; $i++) {
          $LCS_Length_Table[$i] = array();
          for($j=0; $j <= $n; $j++) {
            $LCS_Length_Table[$i][$j] = 0;
          }
        }

        for ($i=1; $i <= $m; $i++) {
          for ($j=1; $j <= $n; $j++) {
            if ($s1[$i-1]==$s2[$j-1])
              $LCS_Length_Table[$i][$j] = $LCS_Length_Table[$i-1][$j-1] + 1;
            else if ($LCS_Length_Table[$i-1][$j] >= $LCS_Length_Table[$i][$j-1])
              $LCS_Length_Table[$i][$j] = $LCS_Length_Table[$i-1][$j];
            else
              $LCS_Length_Table[$i][$j] = $LCS_Length_Table[$i][$j-1];
          }
        }
        return $LCS_Length_Table[$m][$n];
      }

      $str1 = $_POST['name']." ".$_POST['surname'];
      $str2 = $result['name']." ".$result['surname'];

      $percent = (LCS_Length($str1,$str2) / strlen($str2));
      if($percent > 0.9) {
        require(__dir__."/env.php");
        require(__dir__."/token.php");
        $gen = new Token(getenv("TOKEN"));
        $token = $gen->hash($_POST['personalID']);
        die('{"success":true, "token": "'.$token.'"}');
      } else {
        die('{"success":false, "msg":"NAME_NOT_MATCH"}');
      }

    } else {
      die('{"success":false, "msg":"ID_NOT_FOUND"}');
    }

  } else {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ../index.php");
  }
?>
