const doctorData = document.querySelectorAll('td[contenteditable = "true"]')
const deleteDoctorBtn = document.querySelectorAll('.deleteBtn')

const specialtyOptions = [];
const statusOptions = ['Activo', 'Inactivo'];

$.ajax({
    url: '../../../app/models/Specialties/getSpecialties.php',
    type: 'GET',
    async: false,
    success: function(response) {
        const specialties = JSON.parse(response);
        specialties.forEach(specialty => {
            specialtyOptions.push(specialty.NombreEspecialidad);
        });
    }
});

doctorData.forEach(data => {
    
    data.addEventListener('click', function(e) {
        const field = this.dataset.field;
        
        if (field == 'NombreEspecialidad' || field == 'Estado') {
            const currentValue = this.textContent;
            const cell = this;
            
            if (cell.querySelector('select')) return;
            
            const options = field == 'NombreEspecialidad' ? specialtyOptions : statusOptions;
            const originalText = cell.textContent;
            cell.textContent = '';
            cell.contentEditable = 'false';
            
            const select = document.createElement('select');
            select.className = 'form-control form-control-sm';
            select.style.width = '100%';
            
            options.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option;
                opt.textContent = option;
                if (option == currentValue) {
                    opt.selected = true;
                }
                select.appendChild(opt);
            });
            
            cell.appendChild(select);
            select.focus();
            
            select.addEventListener('change', function() {
                const newValue = this.value;
                cell.textContent = newValue;
                cell.contentEditable = 'true';
                
                const idDoctor = cell.closest('tr').dataset.doctorId;
                $.ajax({
                    url: '../../../app/models/Doctors/updateDoctor.php',
                    type: 'POST',
                    data: {
                        idDoctor: idDoctor,
                        column: field,
                        change: newValue
                    }
                });
            });
            
            select.addEventListener('blur', function() {
                if (cell.querySelector('select')) {
                    cell.textContent = select.value || originalText;
                    cell.contentEditable = 'true';
                }
            });
            
            e.stopPropagation();
        }
    });

    data.addEventListener('blur', function() {
        if (this.querySelector('select')) return;

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