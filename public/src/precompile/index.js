'use strict';

var web = function () {
  'use strict';

  var provinceList = void 0;
  var registerFormat = void 0;

  var resize = function resize() {
    var height = void 0,
        size = void 0;

    height = $(window).height() * 0.7;
    $('.head-bg').css('height', height);
    $('.head-bg .text-center').css('margin-top', (height - $('.head-bg .text-center').height()) / 2);

    size = 100;
    $('.form-section .number-box').css({
      width: size,
      height: size
    });

    $('.form-section .number-box, .form-section .description').each(function (id, elm) {
      $(elm).css({
        paddingTop: (size - parseInt($(elm).css('font-size'))) / 2 - 15
      }).show();
    });
  };

  var initStyle = function initStyle() {

    resize();

    $.ajax({
      url: 'src/provinceList.json',
      async: false,
      dataType: 'json',
      success: function success(res) {
        provinceList = res;
      },
      error: function error() {
        console.error('Can\'t Download ProvinceList');
        $('#err-cnn').modal('show');
      }
    });

    $.ajax({
      url: 'src/registerFormat.json',
      async: false,
      dataType: 'json',
      success: function success(res) {
        registerFormat = res;
        for (var i = 0; i < registerFormat.length; i++) {
          if (registerFormat[i].title == 'province') {
            registerFormat[i].valid = provinceList;
          }
        }
      },
      error: function error() {
        console.error('Can\'t Download ProvinceList');
        $('#err-cnn').modal('show');
      }
    });

    $('.register-form .i-province select').append(provinceList.map(function (v) {
      return '<option value="' + v + '">' + v + '</option>';
    }).join(''));

    $('.register-form .submit').click(submit);
  };

  /**
   * EMPTY, TOO_LONG, REGEX_INCORRECT, NO_MATCH, PROP_NOT_FOUND
   **/
  var validate = function validate(str, prop, format) {

    str = $.trim(str);

    for (var i = 0; i < format.length; i++) {
      var form = format[i];
      if (form.title === prop) {

        if (!form.nonRequire) {
          if (typeof str === 'undefined' || str === null || str.length === 0) return {
            success: false,
            msg: 'EMPTY'
          };
        }

        if (form.type === 'text') {

          if (form.valid.legnth) {
            if (str.length > parseInt(form.valid.length)) return {
              success: false,
              msg: 'TOO_LONG'
            };
          }

          if (form.valid.regex) {
            if (!new RegExp(form.valid.regex, "g").test(str)) return {
              success: false,
              msg: 'REGEX_INCORRECT'
            };
          }

          return {
            success: true
          };
        }

        if (form.type == 'enum') {
          for (var j = 0; j < form.valid.length; j++) {
            if (form.valid[j] == str) {
              return {
                success: true
              };
            }
          }

          return {
            success: false,
            msg: 'NO_MATCH'
          };
        }
      }
    }

    return {
      success: false,
      msg: 'PROP_NOT_FOUND'
    };
  };

  var submit = function submit() {
    var val = void 0;
    var message = "";
    var send = {};

    for (var i = 0; i < registerFormat.length; i++) {

      var $top = $('.register-form .i-' + registerFormat[i].title);

      if (registerFormat[i].type === 'enum') {
        val = $top.find('select').val();
      } else {
        val = $top.find('input').val();
      }

      send[registerFormat[i].title] = val;

      var resp = validate(val, registerFormat[i].title, registerFormat);

      if (resp.success) {
        $top.removeClass('err');
        continue;
      } else {
        $top.addClass('err');
      }

      if (message === "") {
        var name = $top.find('.title').html();
        if (name.indexOf('<') != -1) name = $.trim(name.substr(0, name.indexOf('<')));
        switch (resp.msg) {
          case 'EMPTY':
            message = "กรุณากรอกข้อมูลใน `" + name + "`";
            break;
          case 'TOO_LONG':
            message = "ข้อความใน `" + name + "` มีขนาดยาวเกินไป";
            break;
          case 'REGEX_INCORRECT':
            message = "ข้อมูลในช่อง `" + name + "` มีรูปแบบไม่ถูกต้อง";
            break;
          case 'NO_MATCH':
            message = "กรุณาเลือกข้อมูลใน `" + name + "`";
            break;
          case 'PROP_NOT_FOUND':
            message = "ERR_IMM : Propertie Not Found.";
            break;
        }
      }
    }

    if (message === "") {
      $.ajax({
        url: 'register.php',
        type: 'POST',
        async: false,
        data: {
          q: 'personalCheck',
          pid: send.personalID
        },
        dataType: 'json',
        beforeSent: function beforeSent() {
          $('.register-form .err-message').text('กำลังตรวจสอบบัตรประชาชน...').show();
        },
        success: function success(res) {
          if (res.status === "duplicate") {
            $('.register-form .i-personalID').addClass('err');
            message = "บัตรประชาชนหมายเลข `" + send.personalID + "` มีคนใช้อยู่แล้ว";
          }
        },
        error: function error() {
          message = 'ERR_CNN : ไม่สามารถตรวจสอบหมายเลขบัตรประชาชนได้';
        }
      });
    }

    if (message === "") {
      $('.register-form .err-message').slideUp();

      $('#confirm').modal({ backdrop: 'static', keyboard: false }).one('click', '.btn-confirm', function () {

        $.ajax({
          url: 'register.php',
          type: 'POST',
          data: {
            q: 'register',
            form: send
          },
          dataType: 'json',
          success: function success(res) {
            if (res.success) {
              window.location.href = "report.php?pid=" + send.personalID + "&token=" + res.token;
            } else {
              $("#confirm").modal('hide');
              $('.register-form .err-message').text('ไม่สามารถสมัครได้ กรุณาลองใหม่อีกครั้ง').show();
              console.error(res);
            }
          },
          error: function error() {
            $("#confirm").modal('hide');
            $('.register-form .err-message').text('ERR_CNN : ไม่สามารถเชื่อมต่ออินเตอร์เน็ตได้').show();
          }
        });
      });
    } else {
      $('.register-form .err-message').text(message).slideDown();
    }
  };

  $(function () {

    $(window).resize(resize);
    initStyle();
  });
}();