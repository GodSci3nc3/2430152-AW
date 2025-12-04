const recordData = document.querySelectorAll('p[contenteditable="true"]')
const saveConsultationBtn = document.getElementById('saveConsultation')
const message = document.getElementById('systemResponse')

if (saveConsultationBtn) {
    saveConsultationBtn.addEventListener('click', function() {
        const patientId = this.dataset.patientId;
        const symptoms = document.getElementById('symptoms').value;
        const diagnosis = document.getElementById('diagnosis').value;
        const treatment = document.getElementById('treatment').value;
        const prescription = document.getElementById('prescription').value;
        const notes = document.getElementById('notes').value;
        const nextAppointment = document.getElementById('nextAppointment').value;

        $.ajax({
            url: '../../../app/models/Records/createRecord.php',
            type: 'POST',
            data: {
                patientId: patientId,
                symptoms: symptoms,
                diagnosis: diagnosis,
                treatment: treatment,
                prescription: prescription,
                notes: notes,
                nextAppointment: nextAppointment
            },
            success: function() {
                message.textContent = 'Consulta guardada exitosamente';
                message.classList.add('active');
                setTimeout(function() {
                    location.reload();
                }, 1500);
            },
            error: function() {
                message.textContent = 'Error al guardar la consulta';
                message.classList.add('active');
            }
        })
    })
}

recordData.forEach(data => {
    data.addEventListener('blur', function() {

        const recordId = this.dataset.recordId;
        const column = this.dataset.field;
        const value = this.textContent;

        if (!recordId) return;

        $.ajax({
            url: '../../../app/models/Records/updateRecord.php',
            type: 'POST',
            data: {
                recordId: recordId,
                column: column,
                change: value
            },
            success: function() {
                message.textContent = 'Campo actualizado';
                message.classList.add('active');
            },
            error: function() {
                message.textContent = 'Error al actualizar';
                message.classList.add('active');
            }
        })

    })
})