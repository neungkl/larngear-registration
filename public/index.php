<?php
  require('backends/env.php');
?>

<!doctype html>
<html lang="th">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>สมัครค่ายลานเกียร์ ครั้งที่ 15</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,300&subset=thai' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <link rel="stylesheet" href="src/precompile/index.css">
  </head>
  <body>
    <div class="container-fluid head-bg">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 text-center">
          <div class="head">สมัครค่ายลานเกียร์ ครั้งที่ 15</div>
          <div class="btn-section">
            <div class="btn btn-default">เคยสมัครแล้ว</div>
            <div class="btn btn-default">ยังไม่เคยสมัคร</div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-section">
      <div class="container">

        <!-- Register Type 1 -->

        <div class="section">
          <div class="row m-t-3 m-b-3">
            <div class="col-xs-12 col-sm-3">
              <div class="number-box center" style="display:none;">
                <i class="fa fa-check"></i>
              </div>
            </div>
            <div class="col-sm-9 col-sm-offset-0 col-xs-offset-1 col-xs-10">
              <div class="description" style="display:none;">
                กรณีที่เคยสมัครแล้ว
                <div class="more">
                  สามารถดาวโหลดเอกสารได้เลย
                </div>
              </div>
          </div>
        </div>
      </div>

      <!-- Register Type 2 -->

      <hr>

      <div class="section">
        <div class="row m-t-3">
          <div class="col-xs-12 col-sm-3">
            <div class="number-box center" style="display:none;">
              <i class="fa fa-times"></i>
            </div>
          </div>
          <div class="col-sm-9 col-sm-offset-0 col-xs-offset-1 col-xs-10">
            <div class="description" style="display:none;">
              ยังไม่เคยสมัครมาก่อน
              <div class="more">
                กรอกรายละเอียดการสมัครที่ด้านล่างนี้ได้เลย
              </div>
            </div>
          </div>
        </div>

        <div class="row m-b-3">
          <div class="col-xs-12 col-md-offset-1 col-md-10">
            <div class="container-fluid register-form">

              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-4">
                  <div class="alert alert-warning">
                    <span class="require" style="font-weight: 400; font-size:1.1em;">*</span> คือ จำเป็นต้องกรอก
                  </div>
                </div>
              </div>

              <div class="row i-prefix">
                <div class="col-sm-3 title">คำนำหน้าชื่อ <span class="require">*</span></div>
                <div class="col-sm-3">
                  <select class="form-control">
                    <option value="-">-</option>
                    <option value="master">เด็กชาย</option>
                    <option value="miss">เด็กหญิง</option>
                    <option value="mr">นาย</option>
                    <option value="mrs">นางสาว</option>
                  </select>
                </div>
              </div>
              <div class="row i-name">
                <div class="col-sm-3 title">ชื่อ <span class="require">*</span></div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" maxlength="30">
                </div>
              </div>
              <div class="row i-surname">
                <div class="col-sm-3 title">นามสกุล <span class="require">*</span></div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" maxlength="30">
                </div>
              </div>
              <div class="row i-nickname">
                <div class="col-sm-3 title">ชื่อเล่น <span class="require">*</span></div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" maxlength="20">
                </div>
              </div>
              <div class="row i-personalID">
                <div class="col-sm-3 title">
                  เลขประจำตัวประชาชน <span class="require">*</span>
                  <div class="more">ไม่ต้องใส่เครื่องหมาย -</div>
                </div>
                <div class="col-sm-8">
                  <input class="form-control" placeholder="ตัวอย่าง : 1399911155566" type="text" maxlength="15">
                </div>
              </div>
              <div class="row i-province">
                <div class="col-sm-3 title">จังหวัดที่อยู่ <span class="require">*</span></div>
                <div class="col-sm-4">
                  <select class="form-control">
                    <option value="-">-</option>
                  </select>
                </div>
              </div>
              <div class="row i-phone">
                <div class="col-sm-3 title">
                  เบอร์โทรศัพท์ <span class="require">*</span>
                  <div class="more">ไม่ต้องใส่เครื่องหมาย -</div>
                </div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" placeholder="ตัวอย่าง : 0812334567" maxlength="10">
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12 m-t-1">
                  <hr>
                </div>
              </div>

              <div class="row i-blood">
                <div class="col-sm-3 title">กรุ๊ปเลือด <span class="require">*</span></div>
                <div class="col-sm-3">
                  <select class="form-control">
                    <option value="-">-</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="O">O</option>
                    <option value="AB">AB</option>
                    <option value="N">ไม่ทราบ</option>
                  </select>
                </div>
              </div>
              <div class="row i-schoolYear">
                <div class="col-sm-3 title">ชั้นปีการศึกษา <span class="require">*</span></div>
                <div class="col-sm-3">
                  <select class="form-control">
                    <option value="-">-</option>
                    <option value="4">ม.4</option>
                    <option value="5">ม.5</option>
                  </select>
                </div>
              </div>
              <div class="row i-school">
                <div class="col-sm-3 title">
                  ชื่อโรงเรียนแบบเต็ม <span class="require">*</span>
                  <div class="more">ไม่ใช้อักษรย่อ</div>
                </div>
                <div class="col-sm-8">
                  <input class="form-control" placeholder="ตัวอย่าง : เตรียมอุดมศึกษา" type="text" maxlength="40">
                </div>
              </div>

              <div class="row i-facebook">
                <div class="col-sm-3 title">
                  Facebook
                </div>
                <div class="col-sm-4">
                  <input class="form-control" type="text" maxlength="30">
                </div>
              </div>
              <div class="row i-line">
                <div class="col-sm-3 title">
                  LineID
                </div>
                <div class="col-sm-4">
                  <input class="form-control" type="text" maxlength="30">
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12 m-t-1">
                  <hr>
                </div>
              </div>

              <div class="row i-parentName">
                <div class="col-sm-3 title">
                  ชื่อ-นามสกุลผู้ปกครอง <span class="require">*</span>
                </div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" maxlength="40">
                </div>
              </div>
              <div class="row i-parentPhone">
                <div class="col-sm-3 title">
                  เบอร์โทรศัพท์ผู้ปกครอง <span class="require">*</span>
                  <div class="more">ไม่ต้องใส่เครื่องหมาย -</div>
                </div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" placeholder="ตัวอย่าง : 0812334567" maxlength="10">
                </div>
              </div>
              <div class="row i-parentRelation">
                <div class="col-sm-3 title">
                  เกี่ยวข้องเป็น <span class="require">*</span>
                </div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" placeholder="บิดา มารดา หรือปู่ ย่า ตา ยาย" maxlength="10">
                </div>
              </div>
              <div class="row i-knowFrom">
                <div class="col-sm-3 title">
                  ได้รับข่าวสารจากทางใด
                </div>
                <div class="col-sm-8">
                  <select class="form-control">
                    <option value="-">-</option>
                  </select>
                </div>
              </div>
              <div class="row i-allegic">
                <div class="col-sm-3 title">
                  อาหารที่แพ้
                </div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" placeholder="เช่น ถั่วปากอ้า กุ้ง อาหารทะเล" maxlength="40">
                </div>
              </div>

              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-8">
                  <div class="alert alert-danger err-message" style="display:none;"></div>
                </div>
              </div>

              <div class="row m-t-1">
                <div class="col-sm-3"></div>
                <div class="col-sm-8">
                  <div class="btn btn-primary btn-lg submit">สมัครค่าย !!!</div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

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
    <script src="src/precompile/index.js"></script>
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
