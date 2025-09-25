var alumnos = [];
var alumnosFiltrados = [];
var paginaActual = 1;
var alumnosPorPagina = 10;

document.addEventListener('DOMContentLoaded', function() {
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
        
        for (var i = 0; i < alumnos.length; i++) {
            if (alumnos[i].matricula === matricula) {
                alert('Ya existe un alumno con esa matrícula');
                return;
            }
        }
        
        alumnos.push({
            matricula: matricula,
            nombre: nombre,
            carrera: carrera,
            email: email,
            telefono: telefono
        });
        
        document.getElementById('matricula').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('carrera').value = '';
        document.getElementById('email').value = '';
        document.getElementById('telefono').value = '';
        
        actualizarTabla();
        alert('Alumno guardado correctamente');
    };
    
    document.getElementById('limpiarBtn').onclick = function() {
        document.getElementById('matricula').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('carrera').value = '';
        document.getElementById('email').value = '';
        document.getElementById('telefono').value = '';
    };
    
    document.getElementById('buscador').oninput = function() {
        actualizarTabla();
    };
    
    document.getElementById('entriesPorPagina').onchange = function() {
        alumnosPorPagina = parseInt(this.value);
        paginaActual = 1;
        mostrarAlumnos();
        actualizarPaginacion();
    };
    
    document.getElementById('anteriorBtn').onclick = function() {
        if (paginaActual > 1) {
            paginaActual--;
            mostrarAlumnos();
            actualizarPaginacion();
        }
    };
    
    document.getElementById('siguienteBtn').onclick = function() {
        var totalPaginas = Math.ceil(alumnosFiltrados.length / alumnosPorPagina);
        if (paginaActual < totalPaginas) {
            paginaActual++;
            mostrarAlumnos();
            actualizarPaginacion();
        }
    };
});

function actualizarTabla() {
    var textoBusqueda = document.getElementById('buscador').value.toLowerCase().trim();
    
    if (textoBusqueda === '') {
        alumnosFiltrados = alumnos.slice();
    } else {
        alumnosFiltrados = [];
        for (var i = 0; i < alumnos.length; i++) {
            var alumno = alumnos[i];
            if (alumno.nombre.toLowerCase().indexOf(textoBusqueda) !== -1 || 
                alumno.matricula.toLowerCase().indexOf(textoBusqueda) !== -1) {
                alumnosFiltrados.push(alumno);
            }
        }
    }
    
    paginaActual = 1;
    mostrarAlumnos();
    actualizarPaginacion();
}

function mostrarAlumnos() {
    var tbody = document.getElementById('tablaBody');
    var inicio = (paginaActual - 1) * alumnosPorPagina;
    var fin = inicio + alumnosPorPagina;
    var alumnosAPaginar = alumnosFiltrados.slice(inicio, fin);
    
    tbody.innerHTML = '';
    
    if (alumnosAPaginar.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6">No hay alumnos que mostrar</td></tr>';
    } else {
        for (var i = 0; i < alumnosAPaginar.length; i++) {
            var alumno = alumnosAPaginar[i];
            var fila = document.createElement('tr');
            fila.innerHTML = 
                '<td>' + alumno.matricula + '</td>' +
                '<td>' + alumno.nombre + '</td>' +
                '<td>' + alumno.carrera + '</td>' +
                '<td>' + alumno.email + '</td>' +
                '<td>' + alumno.telefono + '</td>' +
                '<td><button onclick="eliminarAlumno(\'' + alumno.matricula + '\')">Eliminar</button></td>';
            tbody.appendChild(fila);
        }
    }
}

function actualizarPaginacion() {
    var totalPaginas = Math.ceil(alumnosFiltrados.length / alumnosPorPagina);
    var paginacion = document.getElementById('paginacion');
    var anteriorBtn = document.getElementById('anteriorBtn');
    var siguienteBtn = document.getElementById('siguienteBtn');
    var paginaInfo = document.getElementById('paginaInfo');
    
    if (totalPaginas > 1) {
        paginacion.style.display = 'block';
        paginaInfo.textContent = 'Página ' + paginaActual + ' de ' + totalPaginas;
        anteriorBtn.disabled = (paginaActual === 1);
        siguienteBtn.disabled = (paginaActual === totalPaginas);
    } else {
        paginacion.style.display = 'none';
    }
}

function eliminarAlumno(matricula) {
    if (confirm('¿Estás seguro de que quieres eliminar este alumno?')) {
        for (var i = 0; i < alumnos.length; i++) {
            if (alumnos[i].matricula === matricula) {
                alumnos.splice(i, 1);
                break;
            }
        }
        
        actualizarTabla();
        alert('Alumno eliminado correctamente');
    }
}
