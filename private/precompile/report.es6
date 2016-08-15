let web = (() => {


  let resize = () => {
    let height, size;

    height = 250;
    $('.head-bg').css('height', height);
    $('.head-bg .text-center').css('margin-top', (height - $('.head-bg .text-center').height()) / 2);

  };

  let init = () => {
    resize();
  };

  $(() => {

    $(window).on('resize', resize);
    init();

  });

})();
