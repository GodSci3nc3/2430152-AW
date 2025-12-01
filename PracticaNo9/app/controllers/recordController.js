const recordData = document.querySelectorAll('p[contenteditable="true"]')
const saveConsultationBtn = document.getElementById('saveConsultation')

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
                location.reload();
            },
            error: function() {
                console.log('Error saving consultation');
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
            error: function() {
                console.log('Error updating record')
            }
        })

    })
})