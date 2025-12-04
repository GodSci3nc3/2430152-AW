const appointmentData = document.querySelectorAll('td[contenteditable = "true"]')
const deleteAppointmentBtn = document.querySelectorAll('.deleteBtn')
const createAppointmentBtn = document.getElementById('createAppointment')

if (createAppointmentBtn) {
    createAppointmentBtn.addEventListener('click', function() {
        const patientId = document.getElementById('selectPatient').value;
        const doctorId = document.getElementById('selectDoctor').value;
        const appointmentDate = document.getElementById('appointmentDate').value;

        if (!patientId || !doctorId || !appointmentDate) {
            alert('Complete los campos requeridos');
            return;
        }

        const formattedDate = appointmentDate.replace('T', ' ') + ':00';

        $.ajax({
            url: '../../../app/models/Appointments/createAppointment.php',
            type: 'POST',
            data: {
                patientId: patientId,
                doctorId: doctorId,
                appointmentDate: formattedDate,
                reason: 'General consultation'
            },
            success: function(response) {
                const data = JSON.parse(response);
                
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Error al crear cita');
                }
            },
            error: function() {
                alert('Error al crear cita');
            }
        })
    })
}

appointmentData.forEach(data => {
    data.addEventListener('blur', function() {

        const appointmentId = this.closest('tr').dataset.appointmentId;
        const column = this.dataset.field;
        const value = this.textContent;

        $.ajax({
            url: '../../../app/models/Appointments/updateAppointment.php',
            type: 'POST',
            data: {
                appointmentId: appointmentId,
                column: column,
                change: value
            },
            error: function() {
                console.log('Error al actualizar cita')
            }
        })

    })
})

deleteAppointmentBtn.forEach(deleteButton => {
    deleteButton.addEventListener('click', function() {

        const appointmentId = this.closest('tr').dataset.appointmentId;
        const appointment = this.closest('tr');

        $.ajax({
            url: '../../../app/models/Appointments/deleteAppointment.php',
            type: 'POST',
            data: {
                appointmentId: appointmentId
            },
            success: function() {
                appointment.remove();
            },
            error: function() {
                alert('Error al eliminar cita');
            }
        })
    })

})