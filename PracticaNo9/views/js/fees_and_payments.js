$(document).ready(function() {

    if ($('#fees').length > 0) {
        try {
            var feesTable = $('#fees').DataTable({
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                searching: true,
                ordering: true,
                info: true,
                paging: true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                    "infoFiltered": "(filtrado de _MAX_ entradas totales)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": activar para ordenar la columna ascendente",
                        "sortDescending": ": activar para ordenar la columna descendente"
                    }
                }
            });
        } catch(e) {
        }
    }
    
    if ($('#paymentsTable').length > 0) {
        try {
            var paymentsTable = $('#paymentsTable').DataTable({
                order: [[0, 'desc']],
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                searching: true,
                ordering: true,
                info: true,
                paging: true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                    "infoFiltered": "(filtrado de _MAX_ entradas totales)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": activar para ordenar la columna ascendente",
                        "sortDescending": ": activar para ordenar la columna descendente"
                    }
                }
            });
        } catch(e) {
        }
    }

    $(document).on('change', '.payment-method', function() {
        const idPago = $(this).data('id');
        const metodoPago = $(this).val();
        
        $.ajax({
            url: '../../../app/models/Payments/updatePayment.php',
            type: 'POST',
            data: {
                idPago: idPago,
                field: 'MetodoPago',
                value: metodoPago
            },
            dataType: 'json',
            success: function(response) {
                if (!response.success) {
                    alert('Error al actualizar');
                    location.reload();
                }
            },
            error: function() {
                alert('Connection error');
            }
        });
    });

    $(document).on('change', '.payment-status', function() {
        const idPago = $(this).data('id');
        const estatusPago = $(this).val();
        
        $.ajax({
            url: '../../../app/models/Payments/updatePayment.php',
            type: 'POST',
            data: {
                idPago: idPago,
                field: 'EstatusPago',
                value: estatusPago
            },
            dataType: 'json',
            success: function(response) {
                if (!response.success) {
                    location.reload();
                }
            },
            error: function() {
            }
        });
    });
});