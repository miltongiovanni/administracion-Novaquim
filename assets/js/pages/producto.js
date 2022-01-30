/* Import TinyMCE */
import tinymce from 'tinymce';

/* Default icons are required for TinyMCE 5.3 or above */
import 'tinymce/icons/default';

/* A theme is also required */
import 'tinymce/themes/silver';

/* Import the skin */
import 'tinymce/skins/ui/oxide/skin.min.css';

/* Import plugins */
import 'tinymce/plugins/advlist';
import 'tinymce/plugins/code';
import 'tinymce/plugins/image';

import 'tinymce/plugins/help';
import 'tinymce/plugins/hr';
import 'tinymce/plugins/paste';
import 'tinymce/plugins/nonbreaking';
import 'tinymce/plugins/media';
import 'tinymce/plugins/image';
import 'tinymce/plugins/imagetools';
import 'tinymce/plugins/preview';

import 'tinymce/plugins/emoticons';
import 'tinymce/plugins/emoticons/js/emojis';
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/table';

/* Import premium plugins */
/* NOTE: Download separately and add these to /src/plugins */
/* import './plugins/checklist/plugin'; */
/* import './plugins/powerpaste/plugin'; */
/* import './plugins/powerpaste/js/wordimport'; */

/* Import content css*/
import 'tinymce/skins/ui/oxide/content.min.css';
import 'tinymce/skins/content/default/content.css';

//Import Dropzone
import Dropzone from "dropzone";
// Optionally, import the dropzone file to get default styling.
import "dropzone/dist/dropzone.css";


tinymce.init({
    selector: '.editor',
    language: 'es_419',
    height: 500,
    toolbar: 'undo redo | styleselect forecolor backcolor| bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent hr | link image media emoticons | preview fullscreen code table | help',
    plugins: 'advlist code help hr image imagetools link lists media nonbreaking paste table preview',
    relative_urls: false,
    remove_script_host: false,
    images_upload_url: '/uploadImage',
    images_upload_base_path: '../uploads/images',
    images_upload_credentials: true,

});

/*
tinymce.init({
    selector: '.tiny-editor',
{% if session.locale == 'fr_CA' %}
language: 'fr_FR',
{% endif %}
height: 500,
    plugins: 'advlist autolink code emoticons fullscreen help hr image link lists media nonbreaking paste preview table '  /!*+'tinydrive'*!/,
    toolbar: 'undo redo | styleselect forecolor backcolor| bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent hr | link customInsertButton image media emoticons | preview fullscreen code table | help ',
    relative_urls: false,
    remove_script_host: false,
    images_upload_url: '{{ appUrl }}websites/uploadfile?type={{ type }}&id={% if id!=0 %}{{ id }}{% else %}{{ newArticleId }}{% endif %}&lang=' + document.getElementById('langue').value,
    images_upload_base_path: '{{ container.env.ExtranetImagesURL }}',
    images_upload_credentials: true,
    setup: function (editor) {
    editor.ui.registry.addButton('customInsertButton', {
        icon: 'browse',
        tooltip: '{{ 'websites.extranet.form.insert.file'|trans }}',
        onAction: function (_) {
            let input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'application/pdf');
            input.onchange = function () {
                var file = this.files[0];
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ appUrl }}websites/uploadfile');
                xhr.onload = function () {
                    let json;
                    if (xhr.status != 200) {
                        alert('HTTP Error: ' + xhr.status);
                        return;
                    } else {
                        json = JSON.parse(xhr.responseText);
                        if (json.site === 'extranet') {
                            editor.insertContent('&nbsp; <a href="{{ container.env.OC_EXTRANET_URL }}download.php?file={{ container.env.ExtranetDocsURL }}' + json.location + '" target="_blank">' + json.fileName + '</a> <strong> </strong>&nbsp;');
                        } else {
                            editor.insertContent('&nbsp; <a href="{{ appUrl }}emembers/docs/' + json.location + '" target="_blank">' + json.location + '</a> <strong> </strong>&nbsp;');
                        }
                    }
                    if (!json || typeof json.location != 'string') {
                        alert('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                };
                formData = new FormData();
                formData.append('file', file);
                formData.append('type', '{{ type }}');
                formData.append('id', {% if id!=0 %}'{{ id }}'
                {% else %}'{{ newArticleId }}'{% endif %})
                ;
                formData.append('lang', document.getElementById('langue').value)
                xhr.send(formData);
            };
            input.click();
        }
    });
}
});*/

$("div#image_1_upload").dropzone({
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
            console.log(imgUrl);
            $('#dropzoneTitle').hide();
            $('#img-preview').show();
            $('#image_1').val(response.location);
        });
    }
});

$("div#image_2_upload").dropzone({
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
            console.log(imgUrl);
            $('#dropzoneTitle2').hide();
            $('#img-preview2').show();
            $('#image_2').val(response.location);
        });
    }
});

$("div#image_3_upload").dropzone({
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
            console.log(imgUrl);
            $('#dropzoneTitle3').hide();
            $('#img-preview3').show();
            $('#image_3').val(response.location);
        });
    }
});

// var photoDropzone = $("div#profile-picture-placeholder").dropzone({
//     url: $("div#profile-picture-upload").data('action'),
//     maxFiles: 1,
//     maxFilesize: 500,
//     acceptedFiles: 'image/*',
//     init: function () {
//         this.on("success", function (file, response) {
//             $('#loader-wrapper').show();
//             var url = $('#profile-picture-placeholder').data('base-url') + '/img/uploads/' + response;
//             $('#profile-picture-placeholder').data('previous-image', $('#profile-picture-placeholder').css('background-image'));
//             $('#profile-picture-placeholder').css('background-image', 'url(' + url + ')');
//             if (HTMLCanvasElement.prototype.toBlob) {
//                 $('#photo-to-crop').attr('src', url);
//                 $('#photo-crop-modal').modal('show');
//             } else {
//                 $('input[name="photo"]').val(response);
//             }
//             $('#uploadedOriginalPhotoName').val(response);
//             this.removeFile(file);
//             $('#loader-wrapper').hide();
//         });
//     }
// });