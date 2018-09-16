let web = (() => {
  'use strict';

  let provinceList;
  let registerFormat;

  let resize = () => {
    let size = 100;
    
    $('.form-section .number-box').css({
      width: size,
      height: size
    });

    $('.form-section .number-box, .form-section .description').each(function(id, elm) {
      $(elm).css({
        paddingTop: (size - parseInt($(elm).css('font-size'))) / 2 - 15
      }).show();
    });
  };

  let initStyle = () => {

    resize();

    $.ajax({
      url: 'src/provinceList.json',
      async: false,
      dataType: 'json',
      success: function(res) {
        provinceList = res;
      },
      error: function() {
        console.error('Can\'t Download ProvinceList');
        $('#err-cnn').modal('show');
      }
    });

    $.ajax({
      url: 'src/registerFormat.json',
      async: false,
      dataType: 'json',
      success: function(res) {
        registerFormat = res;
        for (let i = 0; i < registerFormat.length; i++) {
          if (registerFormat[i].title == 'province' ||
              registerFormat[i].title == 'schoolProvince') {
            registerFormat[i].valid = provinceList;
          }
        }
      },
      error: function() {
        console.error('Can\'t Download RegisterFormat');
        $('#err-cnn').modal('show');
      }
    });

    $('#register-form .i-province select, #register-form .i-schoolProvince select').append(
      provinceList.map(function(v) {
        return '<option value="' + v + '">' + v + '</option>';
      }).join('')
    );

    $('#register-form .err-message, #skip-form .err-message').hide();

    $('#register-form .submit').click(submit);
    $('#skip-form .submit').click(skipSubmit);

    $('#register-description .submit').click(function() {
      if($('#register-description .checkbox input')[0].checked) {
        $('#register-description').fadeOut(function() {
          $('#register-form').fadeIn();

          $('html, body').animate({
              scrollTop: $('#register-form .i-prefix').prev().offset().top
          }, 500);

        });
      } else {
        $('#register-description .checkbox')
          .addClass('alert alert-danger');
      }

    });

    $('#btn-skip').click(function() {
      $('html, body').animate({
          scrollTop: $('#skip-form').parents('.section').offset().top
      }, 500);
    });

    $('#btn-regist').click(function() {
      $('html, body').animate({
          scrollTop: $('#register-form').parents('.section').offset().top
      }, 500);
    });
  };

  /**
   * EMPTY, TOO_LONG, REGEX_INCORRECT, NO_MATCH, PROP_NOT_FOUND
   **/
  let validate = (str, prop, format) => {

    str = $.trim(str);

    for (let i = 0; i < format.length; i++) {
      let form = format[i];
      if (form.title === prop) {

        if(!form.nonRequire) {
          if (typeof str === 'undefined' || str === null || str.length === 0)
            return {
              success: false,
              msg: 'EMPTY'
            };
        }

        if (form.type === 'text' || form.type === 'longtext') {

          if (form.valid.legnth) {
            if (str.length > parseInt(form.valid.length))
              return {
                success: false,
                msg: 'TOO_LONG'
              };
          }

          if (form.valid.regex) {
            if (!(new RegExp(form.valid.regex, "g").test(str)))
              return {
                success: false,
                msg: 'REGEX_INCORRECT'
              };
          }

          return {
            success: true
          };
        }

        if (form.type == 'enum') {
          for (let j = 0; j < form.valid.length; j++) {
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

  let submit = () => {
    let val;
    let message = "";
    let send = {};

    for (let i = 0; i < registerFormat.length; i++) {

      let $top = $('#register-form .i-' + registerFormat[i].title);

      if (registerFormat[i].type === 'enum') {
        val = $top.find('select').val();
      } else if(registerFormat[i].type === 'longtext') {
        val = $top.find('textarea').val();
      } else {
        val = $top.find('input').val();
      }

      send[registerFormat[i].title] = val;

      let resp = validate(val, registerFormat[i].title, registerFormat);

      if (resp.success) {
        $top.removeClass('err');
        continue;
      } else {
        $top.addClass('err');
      }

      if (message === "") {
        let name = $top.find('.title').html();
        if (name.indexOf('<') != -1) name = $.trim(name.substr(0, name.indexOf('<')));
        switch (resp.msg) {
          case 'EMPTY':
            message = "กรุณากรอกข้อมูลในช่อง `" + name + "`";
            break;
          case 'TOO_LONG':
            message = "ข้อความในช่อง `" + name + "` มีขนาดยาวเกินไป";
            break;
          case 'REGEX_INCORRECT':
            message = "ข้อมูลในช่อง `" + name + "` มีรูปแบบไม่ถูกต้อง";
            break;
          case 'NO_MATCH':
            message = "กรุณาเลือกข้อมูลในช่อง `" + name + "`";
            break;
          case 'PROP_NOT_FOUND':
            message = "ERR_IMM : Property Not Found.";
            break;
        }
      }
    }

    if(message === "") {
      $.ajax({
        url: 'check-id.php',
        type: 'POST',
        async: false,
        data: {
          pid: send.personalID
        },
        dataType: 'json',
        beforeSent: function() {
          $('#register-form .err-message').text('กำลังตรวจสอบบัตรประชาชน...').show();
        },
        success: function(res) {
          if(res.status === "duplicate") {
            $('#register-form .i-personalID').addClass('err');
            message = "บัตรประชาชนหมายเลข `" + send.personalID + "` มีคนใช้อยู่แล้ว";
          }
        },
        error: function() {
          message = 'ERR_CNN : ไม่สามารถตรวจสอบหมายเลขบัตรประชาชนได้';
        }
      });
    }

    if (message === "") {
      $('#register-form .err-message').slideUp();

      $('#confirm')
        .modal({ backdrop: 'static', keyboard: false })
        .one('click', '.btn-confirm', function() {

          $.ajax({
            url: 'register.php',
            type: 'POST',
            data : {
              form: send
            },
            dataType: 'json',
            success: function(res) {
              if(res.success) {
                window.location.href = "report.php?pid=" + send.personalID + "&token=" + res.token;
              } else if(res.msg === "end") {
                $("#confirm").modal('hide');
                $('#register-form .err-message').html('<i class="fa fa-exclamation-triangle"></i> หมดเวลาการรับสมัครแล้วจ้า').show();
              } else {
                $("#confirm").modal('hide');
                $('#register-form .err-message').html('<i class="fa fa-exclamation-triangle"></i> ไม่สามารถสมัครได้ กรุณาลองใหม่อีกครั้ง<br> ERR_CODE : ' + res.msg.toUpperCase()).show();
                console.error(res);
              }
            },
            error: function() {
              $("#confirm").modal('hide');
              $('#register-form .err-message').html('<i class="fa fa-exclamation-triangle"></i> ').append('ERR_CNN : ไม่สามารถเชื่อมต่ออินเตอร์เน็ตได้').show();
            }
          });

        });
    } else {
      $('#register-form .err-message').html('<i class="fa fa-exclamation-triangle"></i> ').append(message).slideDown();
    }
  };

  let skipSubmit = () => {

    let data = {
      personalID : $.trim($('#skip-form .personalID input').val()),
      name : $.trim($('#skip-form .name input').val()),
      surname: $.trim($('#skip-form .surname input').val())
    };

    let err = (txt) => {
      $('#skip-form .err-message').html('<i class="fa fa-exclamation-triangle"></i> ').append(txt).slideDown();
    };

    if(data.personalID === null || data.personalID.length === 0) {
      err('กรุณากรอก "หมายเลขบัตรประชาชน"');
    } else if(data.name === null || data.name.length === 0) {
      err('กรุณากรอก "ชื่อ"');
    } else if(data.surname === null || data.surname.length === 0) {
      err('กรุณากรอก "นามสกุล"');
    } else if(!(new RegExp("^[1-9][0-9]{12}$").test(data.personalID))) {
      err('"หมายเลขบัตรประชาชน" ไม่ถูกต้อง');
    } else {
      $('#skip-form .err-message').slideUp();
      $.ajax({
        url: 'backends/skipcheck.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(res) {
          if(res.success) {
            window.location.href = "report.php?pid=" + data.personalID + "&token=" + res.token;
          } else if(res.msg === "NAME_NOT_MATCH") {
            err('ชื่อ-นามสกุล ไม่ตรงกับข้อมูลการสมัครที่ใช้บัตรประชาชนหมายเลขนี้');
          } else if(res.msg === "ID_NOT_FOUND") {
            err('ไม่พบบัตรประชาชนหมายเลข "' + data.personalID + '" ในระบบ');
          } else {
            err('กรุณากรอกข้อมูล');
          }
        },
        error: function() {
          err('ERR_CNN : ไม่สามารถเชื่อมต่ออินเตอร์เน็ต กรุณาลองอีกครั้ง');
        }
      });
    }

  };

  $(() => {

    $(window).resize(resize);
    initStyle();

  });

})();
