'use strict';

let web = (() => {

  let provinceList;
  let registerFormat;

  let initStyle = () => {

    let height, size;

    height = $(window).height() * 0.7;
    $('.head-bg').css('height', height);
    $('.head-bg .text-center').css('margin-top', (height - $('.head-bg .text-center').height()) / 2);

    size = 100;
    $('.form-section .number-box').css({
      width: size,
      height: size
    })

    $('.form-section .number-box, .form-section .description').each(function(id, elm) {
      $(elm).css({
        paddingTop: (size - parseInt($(elm).css('font-size'))) / 2 - 15
      }).show();
    });

    $.ajax({
      url: 'src/provinceList.json',
      async: false,
      dataType: 'json',
      success: function(res) {
        provinceList = res;
      },
      error: function() {
        console.error('Can\'t download provinceList');
      }
    });

    $.ajax({
      url: 'src/registerFormat.json',
      async: false,
      dataType: 'json',
      success: function(res) {
        registerFormat = res;
        for(let i=0; i<registerFormat.length; i++) {
          if(registerFormat[i].title == 'province') {
            registerFormat[i].valid = provinceList;
          }
        }
      },
      error: function() {
        console.error('Can\'t download provinceList');
      }
    });

    console.log(provinceList, registerFormat);

    $('.register-form .i-province select').append(
      provinceList.map(function(v) {
        return '<option value="' + v + '">' + v + '</option>';
      }).join('')
    );

  }

  let validate = (str, prop) => {

    str = $.trim(str);

    for(let i=0; i<format.length; i++) {
      let form = format[i];
      if(form.title === prop) {
        if(form.type === 'text') {

          if(str.length === 0)
            return {
              success: false,
              msg: 'EMPTY'
            };

          if(form.legnth) {
            if(str.length > parseInt(form.length))
              return {
                success: false,
                msg: 'TOO_LONG'
              };
          }

          if(form.regex) {
            if(!(new RegEx(form.regex, "g").test(str)))
              return {
                success: false,
                msg: 'REGEX_INCORRECT'
              };
          }

          return {
            success: true
          }
        }

        if(form.type == 'enum') {
          for(let j=0; j<form.valid.length; j++) {
            if(form.valid[j] == str) {
              return {
                success: true
              }
            }
          }

          return {
            success: false,
            msg: 'NO_MATCH'
          }
        }

      }
    }

    return {
      success: false,
      msg: 'PROP_NOT_FOUND'
    };
  };

  $(() => {

    $(window).resize(initStyle)
    initStyle();

  });

})();
