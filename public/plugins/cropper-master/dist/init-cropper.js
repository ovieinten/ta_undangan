$(function () {

    'use strict';

    var console = window.console || { log: function () {} };
    var URL = window.URL || window.webkitURL;
    var $image = $('#image');
    // var $download = $('#download');

    var options = {
        aspectRatio: 16 / 9,
        preview: '.img-preview',
        crop: function (e) {
            $('#imgh').val(cropper.getCroppedCanvas().toDataURL('image/jpeg'));
        }
    };
    var originalImageURL = $image.attr('src');
    var uploadedImageName = 'cropped.jpg';
    var uploadedImageType = 'image/jpeg';
    var uploadedImageURL;


    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();


    // Cropper
    $image.on({
        crop: function (e) {


        }
    }).cropper(options);

    // Import image
    var $inputImage = $('#cover');

    if (URL) {
        $inputImage.change(function () {
            var files = this.files;
            var file;

            if (!$image.data('cropper')) {
                return;
            }

            if (files && files.length) {
                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    uploadedImageName = file.name;
                    uploadedImageType = file.type;

                    if (uploadedImageURL) {
                        URL.revokeObjectURL(uploadedImageURL);
                    }

                    uploadedImageURL = URL.createObjectURL(file);
                    $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
                    $inputImage.val('');
                } else {
                    window.alert('Please choose an image file.');
                }
            }
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }

});
