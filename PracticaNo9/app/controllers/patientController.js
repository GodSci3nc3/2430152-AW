const patientData = document.querySelectorAll('td[contenteditable = "true"]')
const deletePatientBtn = document.querySelectorAll('.deleteBtn')

patientData.forEach(data => {
    data.addEventListener('blur', function() {

        const idPatient = this.closest('tr').dataset.patientId;
        const column = this.dataset.field;
        const value = this.textContent;

        $.ajax({
            url: '../../../app/models/Patients/updatePatient.php',
            type: 'POST',
            data: {
                idPatient: idPatient,
                column: column,
                change: value
            },
            error: function() {
                console.log('Error in ajax about update patient')
            }
        })

    })
})


deletePatientBtn.forEach(deleteButton => {
    deleteButton.addEventListener('click', function() {

        const idPatient = this.closest('tr').dataset.patientId;
        const patient = this.closest('tr');

        $.ajax({
            url: '../../../app/models/Patients/deletePatient.php',
            type: 'POST',
            data: {
                IdPaciente: idPatient
            },
            success: function() {
                patient.remove();
            },
            error: function() {
                console.log('Error in ajax to delete Patient')
            }
        })
    })

})