/* Import TinyMCE */
import tinymce from 'tinymce';
import '../langs/es.js'

//Import Dropzone
import Dropzone from "dropzone";
// Optionally, import the dropzone file to get default styling.
import "dropzone/dist/dropzone.css";


tinymce.init({
    license_key: 'gpl',
    promotion: false,
    selector: '.editor',
    base_url: 'https://cdn.jsdelivr.net/npm/tinymce@8.3.2',
    //content_css: window.TINYMCE_CONTENT_CSS,
    skin: 'oxide',
    content_css: 'default',
    language: 'es',
    height: 500,
    toolbar: 'undo redo | styleselect forecolor backcolor| bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent hr | link image media emoticons | preview fullscreen code table | help',
    plugins: 'advlist code help image link lists media nonbreaking table preview',
    relative_urls: false,
    remove_script_host: false,
    images_upload_url: '/uploadImage',
    images_upload_base_path: '/uploads/images',
    images_upload_credentials: true,

});

document.addEventListener('DOMContentLoaded', () => {

    const myDropzone1 = new Dropzone("div#image_1_upload", {
        url: "/uploadImage",
        maxFiles: 1,
        dictMaxFilesExceeded: 'Only 1 Image can be uploaded',
        acceptedFiles: 'image/*',
        createImageThumbnails: true,
        thumbnailMethod: 'contain',
        maxFilesize: 3,  // in Mb
        init: function () {
            this.on("success", function (file, response) {
                let imgUrl = $('#image_1_upload').data('base-url') + 'uploads/images/' + response.location;
                //$('div.dz-success').remove();
                $('#img-product').attr('src', imgUrl);
                this.removeFile(file);
                $('#dropzoneTitle').hide();
                $('#img-preview').show();
                $('#image_1').val(response.location);
            });
        }
    });

    const myDropzone2 = new Dropzone("div#image_2_upload", {
        url: "/uploadImage",
        maxFiles: 1,
        dictMaxFilesExceeded: 'Only 1 Image can be uploaded',
        acceptedFiles: 'image/*',
        createImageThumbnails: true,
        thumbnailMethod: 'contain',
        maxFilesize: 3,  // in Mb
        init: function () {
            this.on("success", function (file, response) {
                let imgUrl = $('#image_2_upload').data('base-url') + 'uploads/images/' + response.location;
                //$('div.dz-success').remove();
                $('#img-product2').attr('src', imgUrl);
                this.removeFile(file);
                $('#dropzoneTitle2').hide();
                $('#img-preview2').show();
                $('#image_2').val(response.location);
            });
        }
    });

    const myDropzone3 = new Dropzone("div#image_3_upload", {
        url: "/uploadImage",
        maxFiles: 1,
        dictMaxFilesExceeded: 'Only 1 Image can be uploaded',
        acceptedFiles: 'image/*',
        createImageThumbnails: true,
        thumbnailMethod: 'contain',
        maxFilesize: 3,  // in Mb
        init: function () {
            this.on("success", function (file, response) {
                let imgUrl = $('#image_3_upload').data('base-url') + 'uploads/images/' + response.location;
                //$('div.dz-success').remove();
                $('#img-product3').attr('src', imgUrl);
                this.removeFile(file);
                $('#dropzoneTitle3').hide();
                $('#img-preview3').show();
                $('#image_3').val(response.location);
            });
        }
    });
});

