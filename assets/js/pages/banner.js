//Import Dropzone
import Dropzone from "dropzone";
// Optionally, import the dropzone file to get default styling.
import "dropzone/dist/dropzone.css";


$("div#background_image_upload").dropzone({
    url: "/uploadImage",
    maxFiles: 1,
    dictMaxFilesExceeded: 'Only 1 Image can be uploaded',
    acceptedFiles: 'image/*',
    createImageThumbnails: true,
    thumbnailMethod: 'contain',
    maxFilesize: 3,  // in Mb
    init: function () {
        this.on("success", function (file, response) {
            let imgUrl = $('#background_image_upload').data('base-url') + 'uploads/images/' + response.location;
            //$('div.dz-success').remove();
            $('#img-background').attr('src', imgUrl);
            this.removeFile(file);
            $('#dropzoneTitle').hide();
            $('#img-preview').show();
            $('#background_image').val(response.location);
        });
    }
});

$("div#front_image_upload").dropzone({
    url: "/uploadImage",
    maxFiles: 1,
    dictMaxFilesExceeded: 'Only 1 Image can be uploaded',
    acceptedFiles: 'image/*',
    createImageThumbnails: true,
    thumbnailMethod: 'contain',
    maxFilesize: 3,  // in Mb
    init: function () {
        this.on("success", function (file, response) {
            let imgUrl = $('#front_image_upload').data('base-url') + 'uploads/images/' + response.location;
            //$('div.dz-success').remove();
            $('#img-front').attr('src', imgUrl);
            this.removeFile(file);
            $('#dropzoneTitle2').hide();
            $('#img-preview2').show();
            $('#front_image').val(response.location);
        });
    }
});
