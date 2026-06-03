<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    'banner' => [
        'path' => './assets/js/pages/banner.js',
        'entrypoint' => true,
    ],
    'pagesDatatables' => [
        'path' => './assets/js/pages/pagesDatatables.js',
        'entrypoint' => true,
    ],
    'producto' => [
        'path' => './assets/js/pages/producto.js',
        'entrypoint' => true,
    ],
    'sweetalert' => [
        'path' => './assets/js/pages/sweetalert.js',
        'entrypoint' => true,
    ],
    'formValidation' => [
        'path' => './assets/js/pages/formValidation.js',
        'entrypoint' => true,
    ],
    'parsley' => [
        'path' => './assets/js/pages/parsley.js',
        'entrypoint' => true,
    ],
    'jquery' => [
        'version' => '3.4.1',
    ],
    'bootstrap' => [
        'version' => '5.3.8',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.8',
        'type' => 'css',
    ],
    'bootstrap-icons/font/bootstrap-icons.min.css' => [
        'version' => '1.13.1',
        'type' => 'css',
    ],
    'datatables.net-bs5' => [
        'version' => '2.3.6',
    ],
    'datatables.net' => [
        'version' => '2.3.6',
    ],
    'datatables.net-bs5/css/dataTables.bootstrap5.min.css' => [
        'version' => '2.3.6',
        'type' => 'css',
    ],
    'datatables.net-responsive-bs5' => [
        'version' => '3.0.8',
    ],
    'datatables.net-responsive' => [
        'version' => '3.0.8',
    ],
    'datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css' => [
        'version' => '3.0.8',
        'type' => 'css',
    ],
    'dropzone' => [
        'version' => '6.0.0-beta.2',
    ],
    'just-extend' => [
        'version' => '5.1.1',
    ],
    'tinymce' => [
        'version' => '8.3.2',
    ],
    'sweetalert2' => [
        'version' => '11.26.24',
    ],
    'datatables.net-plugins/i18n/es-CO.mjs' => [
        'version' => '2.3.6',
    ],
    'parsleyjs' => [
        'version' => '2.9.2',
    ],
    'parsleyjs/dist/i18n/es.js' => [
        'version' => '2.9.2',
    ],
    'perfect-scrollbar' => [
        'version' => '1.5.6',
    ],
    'perfect-scrollbar/css/perfect-scrollbar.min.css' => [
        'version' => '1.5.6',
        'type' => 'css',
    ],
    'dropzone/dist/dropzone.css' => [
        'version' => '6.0.0-beta.2',
        'type' => 'css',
    ],
];
