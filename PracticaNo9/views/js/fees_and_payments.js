$(document).ready(function() {
    // DataTable para tarifas
    $('#fees').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json'
        }
    });
    
    // DataTable para pagos
    $('#paymentsTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json'
        },
        order: [[0, 'desc']]
    });

    // Actualizar método de pago
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
                if (response.success) {
                    location.reload();
                }
            }
        });
    });

    // Actualizar estado de pago
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
                if (response.success) {
                    location.reload();
                }
            }
        });
    });
});