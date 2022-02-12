$(document).ready(function () {
    $('#usersDatatable').DataTable({
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
    });
    $('#configurationsDatatable').DataTable({
        "columnDefs":
            [
                {
                    "targets": [0],
                    "className": 'dt-body-center'
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
    });
    $('#categoriesDatatable').DataTable({
        "columnDefs":
            [
                {
                    "targets": [0],
                    "className": 'dt-body-center'
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
    });
    $('#productosDatatable').DataTable({
        "columnDefs":
            [
                {
                    "targets": [0, 3, 5],
                    "className": 'dt-body-center'
                },
                {
                    "targets": [3],
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
        "order": [[ 1, "asc" ]]
    });
});