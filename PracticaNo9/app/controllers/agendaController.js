const createEntryBtn = document.getElementById('createEntry');
const deleteButtons = document.querySelectorAll('.deleteBtn');

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

if (createEntryBtn) {
    createEntryBtn.addEventListener('click', function() {
        window.location.href = 'agendaDetails.php';
    });
}

deleteButtons.forEach(deleteBtn => {
    deleteBtn.addEventListener('click', function() {
        const entryId = this.closest('tr').dataset.entryId;
        const row = this.closest('tr');

        if (!confirm('¿Eliminar esta entrada de la agenda?')) {
            return;
        }

        $.ajax({
            url: '../../../app/models/Agenda/deleteAgenda.php',
            type: 'POST',
            data: { id: entryId },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.success) {
                    row.remove();
                    showSystemResponse('success', 'Entrada eliminada');
                } else {
                    showSystemResponse('error', data.message || 'Error al eliminar');
                }
            },
            error: function() {
                showSystemResponse('error', 'Error de conexión');
            }
        });
    });
});
