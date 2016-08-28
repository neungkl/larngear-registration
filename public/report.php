<?php
  require('backends/env.php');
  require('backends/connect.php');
  require('backends/token.php');

  $token = new Token(getenv('TOKEN'));

  $pass = false;
  if(!isset($_GET['pid']) && !isset($_GET['token'])) {
    $msg = '<div style="margin: 20px 0px;" class="alert alert-danger">ERR_URL_PARAMS : The URL parameters are incorrect.</div>';
  } else if(!$token->check($_GET['pid'], $_GET['token'])) {
    $msg = '<div style="margin: 20px 0px;" class="alert alert-danger">ERR_TOKEN : Token is incorrect.</div>';
  } else {
    $t = $conn->query("SELECT code,prefix,name,surname FROM student WHERE personalID=\"{$_GET['pid']}\"");
    $data = $t->fetch_assoc();
    $pass = true;

    switch($data['prefix']) {
      case 'master' : $data['prefix'] = 'เด็กชาย'; break;
      case 'miss' : $data['prefix'] = 'เด็กหญิง'; break;
      case 'mr' : $data['prefix'] = 'นาย'; break;
      case 'mrs' : $data['prefix'] = 'นางสาว'; break;
    }
  }

?>

<!--
  Develope & Design by : Kosate Limpongsa
//-->

<!doctype html>
<html lang="th">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ค่ายลานเกียร์ ครั้งที่ 16</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,300&subset=thai' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <link rel="icon" type="image/png" href="./favicon.png">
    <link rel="stylesheet" href="src/precompile/report.css">
  </head>
  <body>
    <div class="container-fluid head-bg">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 text-center">
          <a href="./index.php" class="head">ค่ายลานเกียร์ ครั้งที่ 16</a>
        </div>
      </div>
    </div>

    <div class="content-section">
      <div class="container">
        <div class="row m-t-3">
          <div class="col-xs-12 col-sm-3">
            <div class="number-box center" style="display:none;">
              <i class="fa fa-download"></i>
            </div>
          </div>
          <div class="col-sm-9 col-sm-offset-0 col-xs-offset-1 col-xs-10">
            <div class="description" style="display:none;">
              <i class="fa fa-download"></i> ดาวโหลดเอกสาร
              <div class="more">
                ดาวโหลดเอกสารสมัครลานเกียร์ได้เลย
              </div>
            </div>
          </div>
        </div>
        <div class="row m-b-3 m-t-2">
          <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <?php
              if(!$pass) {
                echo $msg;
              } else {
            ?>

            <div class="jumbotron m-t-1 m-b-1">
              <h3>การส่งใบสมัคร</h3>
              <ol>
                <li>กรอกข้อมูลการสมัครบนเว็บไซต์ (<i class="fa fa-check"></i> เรียบร้อยแล้ว)</li>
                <li>ดาวโหลด "เอกสารประกอบการสมัคร" ที่ด้านล่างนี้ แล้วตอบคำถามให้ครบ</li>
                <li>ดาวโหลด "ใบปะหน้าซอง" ที่ด้านล่างนี้</li>
                <li>ส่ง "เอกสารประกอบการสมัคร" ใส่ซองจดหมาย พร้อมกับแนบสำเนาบัตรประชาชน และ เอกสารที่แสดงว่ากำลังศึกษาอยู่ในระดับชั้นมัธยมศึกษาชั้นปีที่ 4 หรือ 5 (ปพ.7) มาในซองด้วย</li>
                <li>ส่งจดหมาย พร้อมกับติด "ใบปะหน้าซอง" ที่ด้านหน้าของซองจดหมาย แล้วส่งมาที่ กืจการนิสิต คณะวิศวกรรมศาสตร์ จุฬาลงกรณ์มหาวิทยาลัย (ระบุไว้แล้วในใบปะหน้าซอง)</li>
              </ol>
              <div class="text text-danger">** การส่งจะต้องส่งเอกสารทั้ง 2 อันพร้อมกันทั้งคู่ โดย "เอกสารประกอบการสมัคร" ใส่ไว้ในซองจดหมาย ส่วน "ใบปะหน้าซอง" ให้ติดด้านหน้าของซองจดหมาย</div>
              <div class="text text-danger">** ส่ง สำเนาบัตรประชาชน และ ปพ.7 มาในซองจดหมายด้วย (พร้อมกับเซ็นต์สำเนาถูกต้อง)</div>
              <h3>สรุปสั้นๆจ้า</h3>
              <div>เอกสาร<span class="text text-danger">ทั้งหมด</span>ที่ใส่ในซองจดหมาย ประกอบด้วย</div>
              <ul>
                <li>"เอกสารประกอบการสมัคร" ที่ดาวโหลดได้จากเว็บไซต์หน้านี้</li>
                <li>สำเนาบัตรประชาชน (พร้อมเซ็นต์สำเนาถูกต้อง)</li>
                <li>ปพ.7 (พร้อมเซ็นต์สำเนาถูกต้อง)</li>
              </ul>
              <div>แล้วติด <span class="text text-danger">"ใบปะหน้าซอง"</span> ที่ดาวโหลดได้จากเว็บหน้านี้ ลงบนหน้าซองของจดหมาย</div>
              <div>แล้วส่งมาที่ กิจการนิสิต คณะวิศวกรรมศาสตร์ จุฬาลงกรณ์มหาวิทยาลัย (ที่อยู่ระบุไว้ในใบปะหน้าซอง)</div>
            </div>

            <div class="container-fluid">
              <div class="row">
                <div class="col-xs-12">
                  <h2>
                    <i class="fa fa-user"></i>
                    <?= $data['prefix']." ".$data['name']." ".$data['surname']." (".$_GET['pid'].")" ?>
                  </h2>
                  <div>หากชื่อ-นามสกุลหรือหมายเลขบัตรประชาชนไม่ถูกต้อง กรุณาติดต่อพี่ๆนะครับ</div>
                </div>
              </div>
              <div class="row download-section">
                <div class="col-md-6 text-center m-t-2">
                  <img src="./images/letteraddress.php?pid=<?= $_GET['pid'] ?>&token=<?= $_GET['token'] ?>" class="img-responsive center">
                  <h4 class="text-center p-t-1">ใบปะหน้าซอง</h4>
                  <div class="more m-b-1"><em>หากรหัสใบปะหน้าซองขึ้นเป็น XXX (ไม่ใช่ LG-รหัส4หลัก)<br>ให้รีบติดต่อพี่ๆอย่างเร็วที่สุด</em></div>
                  <a href="./images/letteraddress.php?pid=<?= $_GET['pid'] ?>&token=<?= $_GET['token'] ?>&download=1">
                    <div class="btn btn-primary"><i class="fa fa-download"></i> ดาวโหลด</div>
                  </a>
                </div>
                <div class="col-md-6 text-center m-t-2">
                  <img src="./images/pattern-background.png" class="img-responsive center">
                  <h4 class="text-center p-t-1">เอกสารประกอบการสมัคร</h4>
                  <div class="text-center btn btn-primary"><i class="fa fa-download"></i> ดาวโหลด</div>
                </div>
              </div>
            </div>

            <?php
              }
            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-section">
      <div class="container p-t-2 p-b-2">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <h3>ติดต่อ</h3>
            <div>หากมีปัญหาใดๆ เกี่ยวกับระบบรับสมัครสามารถติดต่อได้ที่</div>
            <ul class="m-t-1">
              <li>พี่ไมค์ 080-296-0066</li>
              <li>พี่โอ 091-819-0691</li>
              <li>พี่ไตเติ้ล 087-303-9711</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div id="err-cnn" class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content panel-danger">
          <div class="modal-header panel-heading">
            การเชื่อมต่ออินเตอร์เน็ตมีปัญหา ?
          </div>
          <div class="modal-body">
            ไม่สามารถโหลดข้อมูลบางอย่างได้ กรุณารีเฟรชหน้านี้ใหม่อีกครั้ง
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-confirm" onclick="javascript:location.reload();">
              ตกลง
            </button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="src/precompile/report.js"></script>
  <?php if(getenv("MODE") === "DEVELOPMENT") { ?>
    <script src="src/precompile/test.js"></script>
    <script id="__bs_script__">
    //<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.14.0.js'><\/script>".replace("HOST", location.hostname));
    //]]>
    </script>
  <?php } ?>
  </body>
</html>
