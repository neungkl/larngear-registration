let test = (() => {

  let ret = {};

  ret.input = () => {
    let inject = {
      'prefix' : 'master',
      'name' : 'อิอิ',
      'surname' : 'อุอุ',
      'nickname': 'หนึ่ง',
      'personalID': '13099011855XX',
      'address' : "ทดสอบ\nอิอิ\nเย้\nอุอุ",
      'postcode': '10330',
      'province': 'กรุงเทพมหานคร',
      'phone': '0812332486',
      'blood': 'A',
      'schoolYear': '4',
      'school': 'รส',
      'schoolProvince': 'นครราชสีมา',
      'facebook': 'neungkl fb',
      'line': 'neungkl line',
      'parentName': 'ชื่อพ่อ',
      'parentPhone': '0854443333',
      'parentRelation': 'พ่อ',
      'knowFrom': '-',
      'allergic': 'แพ้แป้ง'
    };

    for(let key in inject) {
      if( $('.register-form .i-' + key + ' select').length === 0 ) {
        $('.register-form .i-' + key + ' input').val(inject[key]);
      } else {
        $('.register-form .i-' + key + ' select').val(inject[key]);
      }
    }

    if(inject.address) {
      $('.register-form .i-address textarea').val(inject.address);
    }
  };

  ret.personalCheck = () => {
    $.ajax({
      url: 'check-id.php',
      type: 'POST',
      data: {
        pid: '1309901185586'
      },
      success: function(res) {
        console.log(res);
      }
    });
  };

  return ret;
})();
