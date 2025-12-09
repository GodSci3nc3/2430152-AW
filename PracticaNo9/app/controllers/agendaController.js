const createEntryBtn = document.getElementById('createEntry');
const deleteButtons = document.querySelectorAll('.deleteBtn');

if (createEntryBtn) {
    createEntryBtn.addEventListener('click', function() {
        window.location.href = 'agendaDetails.php';
    });
}

deleteButtons.forEach(deleteBtn => {
    deleteBtn.addEventListener('click', function() {
        const entryId = this.closest('tr').dataset.agendaId;
        const row = this.closest('tr');

        $.ajax({
            url: '../../../app/models/Agenda/deleteAgenda.php',
            type: 'POST',
            data: { id: entryId },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.success) {
                    row.remove();
                }
            }
        });
    });
});
