'use strict';

var web = function () {

  var resize = function resize() {
    var height = void 0,
        size = void 0;

    height = 250;
    $('.head-bg').css('height', height);
    $('.head-bg .text-center').css('margin-top', (height - $('.head-bg .text-center').height()) / 2);
  };

  var init = function init() {
    resize();
  };

  $(function () {

    $(window).on('resize', resize);
    init();
  });
}();