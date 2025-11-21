const fee_and_PaymentsData = document.querySelectorAll('td[contenteditable = "true"]')
const deleteFeeBtn = document.querySelectorAll('.deleteBtn')

fee_and_PaymentsData.forEach(data => {
    data.addEventListener('blur', function() {

        const idFee = this.closest('tr').dataset.feeId;
        const column = this.dataset.field;
        const value = this.textContent;

        $.ajax({
            url: '../../../app/models/Fees/updateFee.php',
            type: 'POST',
            data: {
                idFee: idFee,
                column: column,
                change: value
            },
            error: function() {
                console.log('Error in ajax about update fee')
            }
        })

    })
})


deleteFeeBtn.forEach(deleteButton => {
    deleteButton.addEventListener('click', function() {

        const idFee = this.closest('tr').dataset.feeId;
        const patient = this.closest('tr');

        $.ajax({
            url: '../../../app/models/Fees/deleteFee.php',
            type: 'POST',
            data: {
                idFee: idFee
            },
            success: function() {
                patient.remove();
            },
            error: function() {
                console.log('Error in ajax to delete fee')
            }
        })
    })

})