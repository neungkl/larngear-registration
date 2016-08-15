<?php
class Token {

  private $extendStr;

  public function __construct($extendStr) {
    $this->extendStr = $extendStr;
  }

  public function hash($pid) {
    return sha1($pid.$this->extendStr);
  }

  public function check($pid, $hash) {
    return $this->hash($pid) == $hash;
  }
}
?>
