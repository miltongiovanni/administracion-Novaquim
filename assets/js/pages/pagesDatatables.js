import DataTable from 'datatables.net-bs5';

import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';

import languageEsCol from 'datatables.net-plugins/i18n/es-CO.mjs';

$(function () {
    let usersDatatable = new DataTable("#usersDatatable",{
        "columnDefs":
            [
                {
                    "targets": [0],
                    "className": 'dt-body-center'
                },
                {
                    "targets": [4],
                    "orderable": false
                }
            ],
        "language": languageEsCol,
    });

    let configurationsDatatable = new DataTable('#configurationsDatatable', {
        "columnDefs":
            [
                {
                    "targets": [0],
                    "className": 'dt-body-center'
                }
            ],
        "language": languageEsCol,
    });

    let categoriesDatatable = new DataTable('#categoriesDatatable', {
        "columnDefs":
            [
                {
                    "targets": [0],
                    "className": 'dt-body-center'
                },
                {
                    "targets": [3 ],
                    "orderable": false,
                    "searchable": false
                }
            ],
        "language": languageEsCol,
    });

    let productosDatatable = new DataTable('#productosDatatable', {
        "columnDefs":
            [
                {
                    "targets": [0, 4, 6],
                    "className": 'dt-body-center'
                },
                {
                    "targets": [4, 6],
                    "orderable": false
                }
            ],
        "language": {
            "lengthMenu": "Mostrando _MENU_ datos por página",
            "zeroRecords": "Lo siento no encontró nada",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay datos disponibles",
            "search": "Búsqueda:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "infoFiltered": "(Filtrado de _MAX_ en total)"

        },
        "order": [[ 0, "asc" ]]
    });

    let bannersDatatable = new DataTable('#bannersDatatable', {
        "columnDefs":
            [
                {
                    "targets": [0, 3, 4, 5],
                    "className": 'dt-body-center'
                },
                {
                    "targets": [3, 4, 5 ],
                    "orderable": false
                }
            ],
        "language": languageEsCol,
        "order": [[ 1, "asc" ]]
    });

    let mercadosDatatable = new DataTable('#mercadosDatatable', {
        "columnDefs":
            [
                {
                    "targets": [0],
                    "className": 'dt-body-center'
                },
                {
                    "targets": [3 ],
                    "orderable": false,
                    "searchable": false
                }
            ],
        "language": languageEsCol,
    });

    let contactosDatatable = new DataTable('#contactosDatatable', {
        "columnDefs":
            [
                {
                    "targets": [0],
                    "className": 'dt-body-center'
                },
                // {
                //     "targets": [3 ],
                //     "orderable": false,
                //     "searchable": false
                // }
            ],
        "language": languageEsCol,
        "order": [[ 0, "desc" ]]
    });

    let distribuidoresDatatable = new DataTable('#distribuidoresDatatable', {
        "columnDefs":
            [
                {
                    "targets": [0, 8, 9],
                    "className": 'dt-body-center'
                },
                {
                    "targets": [8, 9 ],
                    "orderable": false,
                    "searchable": false
                }
            ],
        "language": languageEsCol,
    });
});