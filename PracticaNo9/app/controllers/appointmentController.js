const appointmentData = document.querySelectorAll('td[contenteditable = "true"]')
const deleteAppointmentBtn = document.querySelectorAll('.deleteBtn')
const createAppointmentBtn = document.getElementById('createAppointment')

if (createAppointmentBtn) {
    createAppointmentBtn.addEventListener('click', function() {
        const patientId = document.getElementById('selectPatient').value;
        const doctorId = document.getElementById('selectDoctor').value;
        const appointmentDate = document.getElementById('appointmentDate').value;

        if (!patientId || !doctorId || !appointmentDate) {
            let message = document.getElementById('systemResponse');
            message.textContent = 'Complete los campos requeridos';
            message.classList.add('active');
            return;
        }

        $.ajax({
            url: '../../../app/models/Appointments/createAppointment.php',
            type: 'POST',
            data: {
                patientId: patientId,
                doctorId: doctorId,
                appointmentDate: appointmentDate,
                reason: 'General consultation'
            },
            success: function() {
                let message = document.getElementById('systemResponse');
                message.textContent = 'Cita creada exitosamente';
                message.classList.add('active');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            },
            error: function() {
                let message = document.getElementById('systemResponse');
                message.textContent = 'Error al crear cita';
                message.classList.add('active');
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
                let message = document.getElementById('systemResponse');
                message.textContent = 'Cita eliminada exitosamente';
                message.classList.add('active');
            },
            error: function() {
                let message = document.getElementById('systemResponse');
                message.textContent = 'Error al eliminar cita';
                message.classList.add('active');
            }
        })
    })

})