$(document).ready(function() {
    const table = $('#appointments').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "order": [[2, 'desc']],
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "columnDefs": [
            { "orderable": false, "targets": 5 }
        ]
    });

    function showSystemResponse(type, message) {
        const responseBox = $('#system-response');
        responseBox.removeClass('alert-success alert-danger alert-warning');
        
        if (type === 'success') {
            responseBox.addClass('alert-success');
        } else if (type === 'error') {
            responseBox.addClass('alert-danger');
        } else {
            responseBox.addClass('alert-warning');
        }
        
        responseBox.text(message).fadeIn();
        
        setTimeout(function() {
            responseBox.fadeOut();
        }, 3000);
    }

    $('#appointments tbody').on('blur', 'td[contenteditable="true"]', function() {
        const cell = table.cell(this);
        const appointmentId = $(this).closest('tr').data('appointment-id');
        const field = $(this).data('field');
        let value = $(this).text().trim();
        
        if (!appointmentId || !field) {
            return;
        }

        // Convertir estados en español a inglés
        if (field === 'EstadoCita') {
            if (value.toLowerCase() === 'completada' || value.toLowerCase() === 'completado') {
                value = 'completed';
                $(this).text('completed');
            } else if (value.toLowerCase() === 'pendiente') {
                value = 'pending';
                $(this).text('pending');
            } else if (value.toLowerCase() === 'cancelada' || value.toLowerCase() === 'cancelado') {
                value = 'cancelled';
                $(this).text('cancelled');
            }
        }

        $.ajax({
            url: '../../../app/models/Appointments/updateAppointment.php',
            method: 'POST',
            data: {
                IdCita: appointmentId,
                field: field,
                value: value
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.success && field === 'EstadoCita' && value === 'completed') {
                    showSystemResponse('success', 'Pago creado automáticamente');
                    setTimeout(() => location.reload(), 1500);
                } else if (!data.success && data.message) {
                    showSystemResponse('error', data.message);
                }
            },
            error: function() {
                showSystemResponse('error', 'Error al actualizar');
            }
        });
    });
});