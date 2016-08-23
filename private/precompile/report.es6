let web = (() => {


  let resize = () => {
    let height, size;

    height = 250;
    $('.head-bg').css('height', height);
    $('.head-bg .text-center').css('margin-top', (height - $('.head-bg .text-center').height()) / 2);

    size = 100;
    $('.content-section .number-box').css({
      width: size,
      height: size
    });

    $('.content-section .number-box, .content-section .description').each(function(id, elm) {
      $(elm).css({
        paddingTop: (size - parseInt($(elm).css('font-size'))) / 2 - 15
      }).show();
    });

  };

  let init = () => {
    resize();
  };

  $(() => {

    $(window).on('resize', resize);
    init();

  });

})();
