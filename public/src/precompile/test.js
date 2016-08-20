'use strict';

var test = function () {

  var ret = {};

  ret.input = function () {
    var inject = {
      'prefix': 'master',
      'name': 'อิอิ',
      'surname': 'อุอุ',
      'nickname': 'หนึ่ง',
      'personalID': '1309901185586',
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
      'allegic': 'แพ้แป้ง'
    };

    for (var key in inject) {
      if ($('.register-form .i-' + key + ' select').length === 0) {
        $('.register-form .i-' + key + ' input').val(inject[key]);
      } else {
        $('.register-form .i-' + key + ' select').val(inject[key]);
      }
    }
  };

  ret.personalCheck = function () {
    $.ajax({
      url: 'register.php',
      type: 'POST',
      data: {
        q: 'personalCheck',
        pid: '1309901185586'
      },
      success: function success(res) {
        console.log(res);
      }
    });
  };

  return ret;
}();