// Variable para almacenar la instancia de DataTable
var tabla;

$(document).ready(function() {
    tabla = $('#tablaAlumnos').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]],
        responsive: true,
        order: [[0, 'asc']], 
        columnDefs: [
            { 
                orderable: false, 
                targets: [5] 
            }
        ]
    });
    
    document.getElementById('guardarBtn').onclick = function() {
        var matricula = document.getElementById('matricula').value.trim();
        var nombre = document.getElementById('nombre').value.trim();
        var carrera = document.getElementById('carrera').value;
        var email = document.getElementById('email').value.trim();
        var telefono = document.getElementById('telefono').value.trim();
        
        if (!matricula || !nombre || !carrera || !email || !telefono) {
            alert('Por favor llena todos los campos');
            return;
        }
        
        var datosTabla = tabla.rows().data().toArray();
        for (var i = 0; i < datosTabla.length; i++) {
            if (datosTabla[i][0] === matricula) { 
                alert('Ya existe un alumno con esa matrícula');
                return;
            }
        }
        
        tabla.row.add([
            matricula,
            nombre,
            carrera,
            email,
            telefono,
            '<button class="btn btn-danger btn-sm" onclick="eliminarAlumno(\'' + matricula + '\')">Eliminar</button>'
        ]).draw();
        
        document.getElementById('matricula').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('carrera').value = '';
        document.getElementById('email').value = '';
        document.getElementById('telefono').value = '';
        
        mostrarModal('El alumno ha sido registrado correctamente');
    };
    
    document.getElementById('limpiarBtn').onclick = function() {
        document.getElementById('matricula').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('carrera').value = '';
        document.getElementById('email').value = '';
        document.getElementById('telefono').value = '';
    };
    
    document.getElementById('cerrarModal').onclick = function() {
        cerrarModal();
    };
});


function eliminarAlumno(matricula) {
    if (confirm('¿Estás seguro de que quieres eliminar este alumno?')) {
        tabla.rows().every(function(rowIdx, tableLoop, rowLoop) {
            var data = this.data();
            if (data[0] === matricula) { 
                this.remove();
                return false; 
            }
        });
        
        tabla.draw();
        mostrarModal('Alumno eliminado correctamente');
    }
}

function mostrarModal(texto) {
    document.getElementById('modalTexto').textContent = texto;
    var modal = new bootstrap.Modal(document.getElementById('modal'));
    modal.show();
}

function cerrarModal() {
    var modal = bootstrap.Modal.getInstance(document.getElementById('modal'));
    if (modal) {
        modal.hide();
    }
}
