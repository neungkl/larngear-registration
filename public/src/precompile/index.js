'use strict';

var web = function () {

  var provinceList = void 0;
  var registerFormat = void 0;

  var initStyle = function initStyle() {

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

    $.ajax({
      url: 'src/provinceList.json',
      async: false,
      dataType: 'json',
      success: function success(res) {
        provinceList = res;
      },
      error: function error() {
        console.error('Can\'t download provinceList');
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
        console.error('Can\'t download provinceList');
      }
    });

    console.log(provinceList, registerFormat);

    $('.register-form .i-province select').append(provinceList.map(function (v) {
      return '<option value="' + v + '">' + v + '</option>';
    }).join(''));
  };

  var validate = function validate(str, prop) {

    str = $.trim(str);

    for (var i = 0; i < format.length; i++) {
      var form = format[i];
      if (form.title === prop) {
        if (form.type === 'text') {

          if (str.length === 0) return {
            success: false,
            msg: 'EMPTY'
          };

          if (form.legnth) {
            if (str.length > parseInt(form.length)) return {
              success: false,
              msg: 'TOO_LONG'
            };
          }

          if (form.regex) {
            if (!new RegEx(form.regex, "g").test(str)) return {
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

  $(function () {

    $(window).resize(initStyle);
    initStyle();
  });
}();
