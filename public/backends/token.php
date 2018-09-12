<?php
class Token {

  private $extendStr;

  public function __construct(string $extendStr) {
    $this->extendStr = $extendStr;
  }

  public function hash(string $pid): string {
    return sha1($pid.$this->extendStr);
  }

  public function check(string $pid, string $hash): bool {
    return $this->hash($pid) == $hash;
  }
}
?>
