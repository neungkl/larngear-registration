<?php
  require('backends/env.php');
  require('backends/connect.php');
  require('backends/token.php');

  $token = new Token(getenv('TOKEN'));

?>

<!doctype html>
<html lang="th">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ค่ายลานเกียร์ ครั้งที่ 15</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,300&subset=thai' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <link rel="stylesheet" href="src/precompile/report.css">
  </head>
  <body>
    <div class="container-fluid head-bg">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 text-center">
          <div class="head">ค่ายลานเกียร์ ครั้งที่ 15</div>
        </div>
      </div>
    </div>

    <div class="content-section">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h1>
            <?php
            if(isset($_GET['pid']) && isset($_GET['token']) && $token->check($_GET['pid'], $_GET['token'])) {
              $t = $conn->query("SELECT code FROM student WHERE personalID=\"{$_GET['pid']}\"");
              $t = $t->fetch_assoc();
              $t = $t['code'];
              echo $t;
            } else {
              echo 'Permission denide';
            }
            ?>
            </h1>
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
