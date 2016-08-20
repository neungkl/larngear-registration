<?php
class Validation {
  private $format;
  private $provinceList;

  public function __construct($format) {
    $this->format = $format;

    $provinceList = file_get_contents(__dir__.'/../src/provinceList.json');
    $this->provinceList = json_decode($provinceList, true);
  }

  public function getRequireField() {
    $ret = array();
    for($i = 0; $i < count($this->format); $i++) {
      if(!isset($this->format[$i]['nonRequire']) || $this->format[$i]['nonRequire'] == false)
        array_push($ret, $this->format[$i]['title']);
    }
    return $ret;
  }

  public function check($str, $prop) {

    $str = trim($str);
    $format = $this->format;

    for ($i = 0; $i < count($format); $i++) {

      $form = $format[$i];

      if ($form['title'] === $prop) {

        if($prop == "province" || $prop == "schoolProvince") {
          $form['valid'] = $this->provinceList;
        }

        if (!isset($form['nonRequire']) || $form['nonRequire'] == false) {
          if (!isset($str) || strlen($str) === 0) return array(
            'success' => 'false',
            'msg' => 'EMPTY'
          );
        }

        if ($form['type'] === 'text' || $form['type'] === 'longtext') {

          if (isset($form['valid']['length'])) {
            if (strlen($str) > (int) $form['valid']['length']) return array(
              'success' => 'false',
              'msg' => 'TOO_LONG'
            );
          }

          if (isset($form['valid']['regex'])) {
            if (!preg_match('/'.$form['valid']['regex'].'/', $str)) return array(
              'success' => 'false',
              'msg' => 'REGEX_INCORRECT'
            );
          }

          return array(
            'success' => 'true'
          );
        }


        if ($form['type'] === 'enum') {

          for ($j = 0; $j < count($form['valid']); $j++) {
            if ($form['valid'][$j] == $str) {
              return array(
                'success' => 'true'
              );
            }
          }

          return array(
            'success' => 'false',
            'msg' => 'NO_MATCH'
          );
        }
      }
    }

    return array(
      'success' => 'false',
      'msg' => 'PROP_NOT_FOUND'
    );
  }
}
?>
