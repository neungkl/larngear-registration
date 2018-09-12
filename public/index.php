<?php require('backends/env.php'); ?>

<!--
  Develope & Design by : Kosate Limpongsa
//-->

<!doctype html>
<html lang="th">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>สมัครค่ายลานเกียร์ ครั้งที่ 18</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,300&subset=thai' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <link rel="icon" type="image/png" href="./favicon.png">
    <link rel="stylesheet" href="src/precompile/index.css">
  </head>
  <body>
    <div class="container-fluid head-bg">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 text-center">
          <div class="head">สมัครค่ายลานเกียร์ ครั้งที่ 18</div>
          <div class="btn-section">
            <div class="btn btn-default skip"><i class="fa fa-check"></i> เคยสมัครแล้ว</div>
            <div class="btn btn-default regist"><i class="fa fa-times"></i> ยังไม่เคยสมัคร</div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-section">
      <div class="container">

        <!-- Register Type 1 -->

        <div class="section">
          <div class="row m-t-3">
            <div class="col-xs-12 col-sm-3">
              <div class="number-box center" style="display:none;">
                <i class="fa fa-check"></i>
              </div>
            </div>
            <div class="col-sm-9 col-sm-offset-0 col-xs-offset-1 col-xs-10">
              <div class="description" style="display:none;">
                <i class="fa fa-check-circle"></i> กรณีที่เคยสมัครแล้ว
                <div class="more">
                  สามารถดาวโหลดเอกสารได้เลย
                </div>
              </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-offset-1 col-md-10">
          <div class="container-fluid skip-form">
            <div class="row personalID">
              <div class="col-sm-3 title">
                เลขประจำตัวประชาชน
                <div class="more">ไม่ต้องใส่เครื่องหมาย -</div>
              </div>
              <div class="col-sm-9">
                <input class="form-control" type="text" maxlength="30">
              </div>
            </div>
            <div class="row">
              <div class="name">
                <div class="col-sm-3 title">
                  ชื่อ
                  <div class="more">ไม่ต้องใส่คำนำหน้าชื่อ</div>
                </div>
                <div class="col-sm-4">
                  <input class="form-control" type="text" maxlength="30">
                </div>
              </div>
              <div class="surname">
                <div class="col-sm-1 title">
                  นามสกุล
                </div>
                <div class="col-sm-4">
                  <input class="form-control" type="text" maxlength="30">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
              </div>
              <div class="col-sm-8">
                <div class="alert alert-danger err-message m-t-1" style="display:none;">test</div>
              </div>
            </div>
            <div class="row m-t-1">
              <div class="col-sm-3">
              </div>
              <div class="col-sm-8">
                <button class="btn btn-primary submit"><i class="fa fa-download"></i> ดาวโหลดเอกสาร</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 m-b-1">
          &nbsp;
        </div>
      </div>

      <!-- Register Type 2 -->

      <hr>

      <?php
        if (getenv("ALLOW_REGISTRATION")) include('components/registration-form.html');
        else include('components/registration-closed.html');
      ?>

    </div>

    <?php include('components/footer.html'); ?>

    <div id="confirm" class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content panel-danger">
          <div class="modal-header panel-heading">
            คุณแน่ใจหรือไม่ที่จะส่งข้อมูลการสมัคร ?
          </div>
          <div class="modal-body">
            ข้อมูลที่กรอกไปแล้วจะ "ไม่" สามารถแก้ไขได้อีก หากกดปุ่มยืนยันการสมัครไปแล้ว
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-confirm">ยืนยันการสมัคร</button>
            <button type="button" data-dismiss="modal" class="btn">กลับไปแก้ไข</button>
          </div>
        </div>
      </div>
    </div>

    <?php include('components/network-error.html'); ?>

    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="src/precompile/index.js"></script>
  <?php if (getenv("MODE") === "DEVELOPMENT") { ?>
    <script src="src/precompile/test.js"></script>
    <script id="__bs_script__">
    //<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.14.0.js'><\/script>".replace("HOST", location.hostname));
    //]]>
    </script>
  <?php } ?>
  </body>
</html>
