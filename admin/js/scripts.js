$(document).ready(function () {
  var user_href;
  var user_href_splitted;
  var user_id;
  var image_href;
  var image_href_splitted;
  var image_name;
  var photo_id;

  // delegated handler works even if modal content is reloaded
  $(document).on('click', '.modal_thumbnails', function (e) {
    e.preventDefault();

    user_href = $('#user-id').prop('href');
    if (user_href) {
      user_href_splitted = user_href.split('=');
      user_id = user_href_splitted[user_href_splitted.length - 1];
    }

    image_href = $(this).prop('src');
    image_href_splitted = image_href.split('/');
    image_name = image_href_splitted[image_href_splitted.length - 1];

    photo_id = $(this).attr('data');

    $.ajax({
      url: 'includes/ajax_code.php',
      data: { photo_id: photo_id },
      type: 'POST',
      success: function (data) {
        if (!data.error) {
          $('#modal_sidebar').html(data);
        }
      },
    });

    $('a.thumbnail').removeClass('active');
    $(this).closest('a.thumbnail').addClass('active');

    $('#set_user_image')
      .prop('disabled', false)
      .removeClass('btn-primary')
      .addClass('btn-success');
  });

  // optional reset when modal closes
  $('#photo-library').on('hidden.bs.modal', function () {
    $('a.thumbnail').removeClass('active');
    image_name = '';
    $('#set_user_image')
      .prop('disabled', true)
      .removeClass('btn-success')
      .addClass('btn-primary');
  });

  $('#set_user_image').on('click', function (e) {
    e.preventDefault();

    $.ajax({
      url: 'includes/ajax_code.php',
      data: { image_name: image_name, user_id: user_id },
      type: 'POST',
      success: function (data) {
        if (data === 'saved') {
          location.reload(true);
        } else {
          alert(data);
        }
      },
    });
  });

  if ($.fn.summernote && $('#summernote').length) {
    $('#summernote').summernote({ height: 300 });
  }

  if (
    typeof Dropzone !== 'undefined' &&
    document.getElementById('photo-dropzone')
  ) {
    Dropzone.autoDiscover = false;
    new Dropzone('#photo-dropzone', {
      paramName: 'file-upload',
      acceptedFiles: 'image/*',
      init: function () {
        this.on('success', function (file, responseText) {
          var isSuccess =
            typeof responseText === 'string' &&
            responseText
              .toLowerCase()
              .indexOf('photo uploaded successfully') !== -1;

          $('#upload-message')
            .removeClass('bg-success bg-danger')
            .addClass(isSuccess ? 'bg-success' : 'bg-danger')
            .html(responseText);
        });

        this.on('error', function (file, errorMessage) {
          $('#upload-message')
            .removeClass('bg-success')
            .addClass('bg-danger')
            .html(errorMessage);
        });
      },
    });
  }

  $('.info-box-header').on('click', () => {
    $('.inside').slideToggle('fast');
    $('#toggle').toggleClass('glyphicon-menu-down glyphicon-menu-up');
  });

  $(document).on('click', 'a[href*="_delete.php?id="]', (e) => {
    if (!confirm('Are you sure you want to delete this item?')) {
      e.preventDefault();
    }
  });
});
