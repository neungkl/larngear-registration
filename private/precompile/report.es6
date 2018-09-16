let web = (() => {


  let resize = () => {
    let size = 100;
    
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
