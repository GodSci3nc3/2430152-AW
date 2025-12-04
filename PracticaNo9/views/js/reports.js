$(document).ready(function() {
    $('#reportsTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json'
        },
        order: [[0, 'desc']]
    });
});

function deleteReport(id) {
    if (!confirm('¿Está seguro de eliminar este reporte?')) {
        return;
    }

    $.ajax({
        url: '../../../app/models/Reports/deleteReport.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                location.reload();
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert('Error al eliminar el reporte');
        }
    });
}
