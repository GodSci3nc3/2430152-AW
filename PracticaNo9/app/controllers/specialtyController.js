const specialtyData = document.querySelectorAll('td[contenteditable = "true"]')
const deleteSpecialtyBtn = document.querySelectorAll('.deleteBtn')

specialtyData.forEach(data => {
    data.addEventListener('blur', function() {

        const idSpecialty = this.closest('tr').dataset.specialtyId;
        const column = this.dataset.field;
        const value = this.textContent;

        $.ajax({
            url: '../../../app/models/Specialties/updateSpecialty.php',
            type: 'POST',
            data: {
                idSpecialty: idSpecialty,
                column: column,
                change: value
            },
            error: function() {
                console.log('Error in ajax about update specialty')
            }
        })

    })
})


deleteSpecialtyBtn.forEach(deleteButton => {
    deleteButton.addEventListener('click', function() {

        const idSpecialty = this.closest('tr').dataset.specialtyId;
        const doctor = this.closest('tr');

        $.ajax({
            url: '../../../app/models/Specialties/deleteSpecialty.php',
            type: 'POST',
            data: {
                idSpecialty: idSpecialty
            },
            success: function() {
                doctor.remove();
            },
            error: function() {
                console.log('Error in ajax to delete specialty')
            }
        })
    })

})