'use strict';

var web = function () {

  var resize = function resize() {
    var size = 100;

    $('.content-section .number-box').css({
      width: size,
      height: size
    });

    $('.content-section .number-box, .content-section .description').each(function (id, elm) {
      $(elm).css({
        paddingTop: (size - parseInt($(elm).css('font-size'))) / 2 - 15
      }).show();
    });
  };

  var init = function init() {
    resize();
  };

  $(function () {

    $(window).on('resize', resize);
    init();
  });
}();