<?php
require('backends/env.php');
if ($_SERVER['REQUEST_METHOD'] !== "POST" || getenv("ALLOW_REGISTRATION") != 1) {
  http_response_code(404);
  die();
}

require('backends/connect.php');

if ($stmt = $conn->prepare("SELECT `personalID` FROM `student` WHERE `personalID` = ?")) {
  $stmt->bind_param("s", $_POST['pid']);
  $stmt->execute();
  $stmt->store_result();
  
  if ($stmt->num_rows() > 0) {
    echo '{"status":"duplicate"}';
  } else {
    echo '{"status":"available"}';
  }
}

$conn->close();
?>
