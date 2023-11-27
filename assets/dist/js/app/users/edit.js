function submitajax(url, data, msg, btn) {
  $.ajax({
    url: url,
    data: data,
    type: 'POST',
    success: function (response) {
      if (response.status) {
        Swal({
          title: 'Successful',
          text: msg,
          type: 'success',
        });
        $('form#change_password').trigger('reset');
      } else {
        if (response.errors) {
          $.each(response.errors, function (key, val) {
            $('[name="' + key + '"]')
              .closest('.form-group')
              .addClass('has-error');
            $('[name="' + key + '"]')
              .nextAll('.help-block')
              .eq(0)
              .text(val);
            if (val === '') {
              $('[name="' + key + '"]')
                .closest('.form-group')
                .removeClass('has-error');
              $('[name="' + key + '"]')
                .nextAll('.help-block')
                .eq(0)
                .text('');
            }
          });
        }
        if (response.msg) {
          Swal({
            title: 'Gagal',
            text: 'Password lama salah',
            type: 'error',
          });
        }
      }
      btn.removeAttr('disabled').text('Simpan');
    },
  });
}

$(document).ready(function () {
  $('form input, form select').on('change', function () {
    $(this).closest('.form-group').removeClass('has-error');
    $(this).nextAll('.help-block').eq(0).text('');
  });

  $('form#user_info').on('submit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    let btn = $('#btn-info');
    btn.attr('disabled', 'disabled').text('Proses...');

    url = $(this).attr('action');
    data = $(this).serialize();
    msg = 'Informasi user sudah berhasil diubah';
    submitajax(url, data, msg, btn);
  });

  $('form#user_level').on('submit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    let btn = $('#btn-level');
    btn.attr('disabled', 'disabled').text('Proses...');

    url = $(this).attr('action');
    data = $(this).serialize();
    msg = 'User level sudah berhasil diubah';
    submitajax(url, data, msg, btn);
  });

  $('form#user_status').on('submit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    let btn = $('#btn-status');
    btn.attr('disabled', 'disabled').text('Proses...');

    url = $(this).attr('action');
    data = $(this).serialize();
    msg = 'User status sudah berhasil diubah';
    submitajax(url, data, msg, btn);
  });
});
