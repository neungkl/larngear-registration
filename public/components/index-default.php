<div class="container-fluid head-bg">
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1 text-center">
      <div class="head">สมัครค่ายลานเกียร์ ครั้งที่ 18</div>
      <div class="btn-section">
        <div id="btn-skip" class="btn btn-default"><i class="fa fa-check"></i> เคยสมัครแล้ว</div>
        <div id="btn-regist" class="btn btn-default"><i class="fa fa-times"></i> ยังไม่เคยสมัคร</div>
      </div>
    </div>
  </div>
</div>

<div id="form-section">
  <div class="container">
    <?php include('download-block.html'); ?>

    <?php
      if (getenv("ALLOW_REGISTRATION")) include('components/registration-block.html');
      else include('components/registration-closed.html');
    ?>
  </div>
</div>

<?php include('components/network-error.html'); ?>

<script src="src/precompile/index.js"></script>
