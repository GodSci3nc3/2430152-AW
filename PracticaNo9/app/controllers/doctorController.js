const doctorData = document.querySelectorAll('td[contenteditable = "true"]')
const deleteDoctorBtn = document.querySelectorAll('.deleteBtn')

doctorData.forEach(data => {
    data.addEventListener('blur', function() {

        const idDoctor = this.closest('tr').dataset.doctorId;
        const column = this.dataset.field;
        const value = this.textContent;

        $.ajax({
            url: '../../../app/models/Doctors/updateDoctor.php',
            type: 'POST',
            data: {
                idDoctor: idDoctor,
                column: column,
                change: value
            },
            error: function() {
                console.log('Error in ajax about update doctor')
            }
        })

    })
})


deleteDoctorBtn.forEach(deleteButton => {
    deleteButton.addEventListener('click', function() {

        const idDoctor = this.closest('tr').dataset.doctorId;
        const doctor = this.closest('tr');

        $.ajax({
            url: '../../../app/models/Doctors/deleteDoctor.php',
            type: 'POST',
            data: {
                idDoctor: idDoctor
            },
            success: function() {
                doctor.remove();
            },
            error: function() {
                console.log('Error in ajax to delete Doctor')
            }
        })
    })

})