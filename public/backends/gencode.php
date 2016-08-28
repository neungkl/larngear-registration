<?php
class GenCode {

  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  private function addZero($txt) {
    switch(strlen($txt)) {
      case 2 : return "0".$txt;
      case 1 : return "00".$txt;
    }
    return $txt;
  }

  public function generate($id, $type) {
    $count = $this->conn->query("SELECT count FROM counter WHERE type=\"$type\"");
    $count = $count->fetch_assoc();
    $count = ((int) $count['count']) + 1;

    $status = true;

    $status &= $this->conn->query("UPDATE counter SET count=\"$count\" WHERE type=\"$type\"");

    $code = "LG-".$type.$this->addZero($count);
    $status &= $this->conn->query("UPDATE student SET code=\"$code\" WHERE personalID=\"$id\"");

    if($status > 0) return 'fail';
    return 'pass';
  }
}
?>
