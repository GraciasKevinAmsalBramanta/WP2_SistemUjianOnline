function load_kelas(id) {
  $('#kelas').find('option').not(':first').remove();

  $.ajax({
    url: base_url + 'kelas/kelas_by_jurusan/' + id,
    type: 'GET',
    success: function (data) {
      var option = [];
      for (let i = 0; i < data.length; i++) {
        option.push({
          id: data[i].id_kelas,
          text: data[i].nama_kelas,
        });
      }
      $('#kelas').select2({
        data: option,
      });
    },
  });
}

$(document).ready(function () {
  ajaxcsrf();

  // Load Kelas By Jurusan
  $('#jurusan').on('change', function () {
    load_kelas($(this).val());
  });

  $('form#mahasiswa input, form#mahasiswa select').on('change', function () {
    $(this).closest('.form-group').removeClass('has-error has-success');
    $(this).nextAll('.help-block').eq(0).text('');
  });

  $('[name="jenis_kelamin"]').on('change', function () {
    $(this).parent().nextAll('.help-block').eq(0).text('');
  });

  $('form#mahasiswa').on('submit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    var btn = $('#submit');
    btn.attr('disabled', 'disabled').text('Wait...');

    $.ajax({
      url: $(this).attr('action'),
      data: $(this).serialize(),
      type: 'POST',
      success: function (data) {
        btn.removeAttr('disabled').text('Simpan Perubahan');
        if (data.status) {
          Swal({
            title: 'Success',
            text: 'Data Berhasil Diubah',
            type: 'success',
          }).then((result) => {
            if (result.value) {
              window.location.href = base_url + 'mahasiswa';
            }
          });
        } else {
          console.log(data.errors);
          $.each(data.errors, function (key, value) {
            $('[name="' + key + '"]')
              .nextAll('.help-block')
              .eq(0)
              .text(value);
            $('[name="' + key + '"]')
              .closest('.form-group')
              .addClass('has-error');
            if (value == '') {
              $('[name="' + key + '"]')
                .nextAll('.help-block')
                .eq(0)
                .text('');
              $('[name="' + key + '"]')
                .closest('.form-group')
                .removeClass('has-error')
                .addClass('has-success');
            }
          });
        }
      },
    });
  });
});
