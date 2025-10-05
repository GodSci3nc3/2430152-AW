// Esperamos que la página cargue completamente
document.addEventListener('DOMContentLoaded', function() {
    
    // ====================
    // MANEJO DE USUARIOS
    // ====================
    
    // Array para guardar todos los usuarios registrados
    let usuarios = [];
    
    // Cargar usuarios guardados del localStorage al inicio
    const usuariosGuardados = localStorage.getItem('usuariosRegistrados');
    if (usuariosGuardados) {
        usuarios = JSON.parse(usuariosGuardados);
        console.log('Usuarios cargados del localStorage:', usuarios.length);
    }
    
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const showRegisterLink = document.getElementById('showRegister');
    const showLoginLink = document.getElementById('showLogin');
    
    if (showRegisterLink) {
        showRegisterLink.addEventListener('click', function(e) {
            e.preventDefault(); 
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
        });
    }
    
    if (showLoginLink) {
        showLoginLink.addEventListener('click', function(e) {
            e.preventDefault();
            registerForm.classList.add('hidden');
            loginForm.classList.remove('hidden');
        });
    }
    
    const formRegistro = document.querySelector('#registerForm form');
    if (formRegistro) {
        formRegistro.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nombre = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (!nombre || !email || !password || !confirmPassword) {
                console.log('Por favor completa todos los campos');
                return;
            }
            
            if (password !== confirmPassword) {
                console.log('Las contraseñas no coinciden');
                return;
            }
            
            const nuevoUsuario = {
                nombre: nombre,
                email: email,
                password: password
            };
            
            // Agregar al array y guardar en localStorage
            usuarios.push(nuevoUsuario);
            guardarUsuarios();
            
            // Guardar como usuario actual (sesión activa)
            localStorage.setItem('usuarioActual', JSON.stringify(nuevoUsuario));
            
            console.log('Usuario registrado exitosamente:', nuevoUsuario);
            window.location.href = 'dashboard.html';
        });
    }
    
    const formLogin = document.querySelector('#loginForm form');
    if (formLogin) {
        formLogin.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            if (!email || !password) {
                console.log('Por favor completa todos los campos');
                return;
            }
            
            // Buscar el usuario en todos los usuarios registrados
            let usuarioEncontrado = null;
            for (let i = 0; i < usuarios.length; i++) {
                if (usuarios[i].email === email && usuarios[i].password === password) {
                    usuarioEncontrado = usuarios[i];
                    break;
                }
            }
            
            if (usuarioEncontrado) {
                // Guardar como usuario actual (sesión activa)
                localStorage.setItem('usuarioActual', JSON.stringify(usuarioEncontrado));
                console.log('Login exitoso');
                window.location.href = 'dashboard.html';
            } else {
                console.log('Email o contraseña incorrectos');
            }
        });
    }
    
    // Función para guardar usuarios en localStorage
    function guardarUsuarios() {
        localStorage.setItem('usuariosRegistrados', JSON.stringify(usuarios));
        console.log('Usuarios guardados en localStorage');
    }
    
    // Proteger el dashboard
    const welcomeTitle = document.querySelector('.welcome-title');
    if (welcomeTitle) {
        const usuarioGuardado = localStorage.getItem('usuarioActual');
        if (!usuarioGuardado) {
            console.log('No hay sesión activa, redirigiendo al login');
            window.location.href = 'auth.html';
            return;
        }
        
        const usuario = JSON.parse(usuarioGuardado);
        welcomeTitle.textContent = `¡Bienvenido, ${usuario.nombre}!`;
        console.log('Usuario loggeado correctamente:', usuario.nombre);
    }
    
    // ====================
    // SISTEMA DE PROYECTOS
    // ====================
    
    // Array para guardar todos los proyectos
    let proyectos = [];
    
    // Cargar proyectos guardados del localStorage al inicio
    const proyectosGuardados = localStorage.getItem('proyectosGuardados');
    if (proyectosGuardados) {
        proyectos = JSON.parse(proyectosGuardados);
        console.log('Proyectos cargados del localStorage:', proyectos.length);
    }
    
    // Si no hay proyectos, crear uno por defecto
    if (proyectos.length === 0) {
        const proyectoPorDefecto = {
            id: 'PROJ-001',
            nombre: 'Sin nombre',
            descripcion: 'Proyecto por defecto para tareas sin proyecto asignado',
            estado: 'activo',
            fecha_inicio: '',
            fecha_fin: ''
        };
        proyectos.push(proyectoPorDefecto);
        guardarProyectos();
        console.log('Proyecto por defecto creado:', proyectoPorDefecto);
    }
    
    // Función para guardar proyectos en localStorage
    function guardarProyectos() {
        localStorage.setItem('proyectosGuardados', JSON.stringify(proyectos));
        console.log('Proyectos guardados en localStorage');
    }
    
    // Elementos del formulario de proyectos
    const addProjectBtn = document.getElementById('addProjectBtn');
    const proyectoNombreInput = document.getElementById('proyectoNombre');
    const proyectoDescripcionInput = document.getElementById('proyectoDescripcion');
    const proyectoEstadoSelect = document.getElementById('proyectoEstado');
    const proyectoFechaInicioInput = document.getElementById('proyectoFechaInicio');
    const proyectoFechaFinInput = document.getElementById('proyectoFechaFin');
    const projectsList = document.getElementById('projectsList');
    
    // Cuando hagan click en "Crear Proyecto"
    if (addProjectBtn) {
        addProjectBtn.addEventListener('click', function() {
            
            // Tomar los valores de los campos del proyecto
            const nombre = proyectoNombreInput.value;
            const descripcion = proyectoDescripcionInput.value;
            const estado = proyectoEstadoSelect.value;
            const fechaInicio = proyectoFechaInicioInput.value;
            const fechaFin = proyectoFechaFinInput.value;
            
            // Verificar que el nombre no esté vacío
            if (nombre === '') {
                console.log('Por favor ingresa un nombre para el proyecto');
                return;
            }
            
            // Generar ID automático para el proyecto
            const nuevoId = 'PROJ-' + String(proyectos.length + 1).padStart(3, '0');
            
            // Crear el nuevo proyecto
            const nuevoProyecto = {
                id: nuevoId,
                nombre: nombre,
                descripcion: descripcion,
                estado: estado,
                fecha_inicio: fechaInicio,
                fecha_fin: fechaFin
            };
            
            // Agregar el proyecto al array
            proyectos.push(nuevoProyecto);
            console.log('Nuevo proyecto creado:', nuevoProyecto);
            console.log('Total de proyectos:', proyectos.length);
            
            // Guardar en localStorage
            guardarProyectos();
            
            // Actualizar la lista de proyectos y el dropdown de tareas
            mostrarProyectos();
            cargarProyectosEnDropdown();
            
            // Limpiar los campos del formulario
            proyectoNombreInput.value = '';
            proyectoDescripcionInput.value = '';
            proyectoEstadoSelect.value = 'activo';
            proyectoFechaInicioInput.value = '';
            proyectoFechaFinInput.value = '';
        });
    }
    
    // Función para mostrar todos los proyectos
    function mostrarProyectos() {
        // Limpiar la lista actual
        projectsList.innerHTML = '';
        
        // Mostrar cada proyecto como una tarjeta pequeña
        for (let i = 0; i < proyectos.length; i++) {
            const proyecto = proyectos[i];
            
            const tarjetaProyecto = document.createElement('div');
            tarjetaProyecto.className = 'badge bg-primary fs-6 p-2';
            tarjetaProyecto.innerHTML = `
                <i class="fas fa-folder me-1"></i>
                ${proyecto.nombre} (${proyecto.estado})
            `;
            
            projectsList.appendChild(tarjetaProyecto);
        }
    }
    
    // Función para cargar proyectos en el dropdown de tareas
    function cargarProyectosEnDropdown() {
        const tareaProyectoSelect = document.getElementById('tareaProyecto');
        
        if (tareaProyectoSelect) {
            // Limpiar opciones actuales
            tareaProyectoSelect.innerHTML = '';
            
            // Agregar cada proyecto como opción
            for (let i = 0; i < proyectos.length; i++) {
                const proyecto = proyectos[i];
                const option = document.createElement('option');
                option.value = proyecto.id;
                option.textContent = proyecto.nombre;
                tareaProyectoSelect.appendChild(option);
            }
        }
    }
    
    // Cargar proyectos al inicio si estamos en el dashboard
    if (projectsList) {
        mostrarProyectos();
        cargarProyectosEnDropdown();
    }
    
    // ====================
    // FUNCIONALIDAD DE TAREAS
    // ====================
    
    // Array para guardar todas las tareas
    let tareas = [];
    
    // Cargar tareas guardadas del localStorage al inicio
    const tareasGuardadas = localStorage.getItem('tareasGuardadas');
    if (tareasGuardadas) {
        tareas = JSON.parse(tareasGuardadas);
        console.log('Tareas cargadas del localStorage:', tareas.length);
    }
    
    // Elementos del formulario de tareas
    const addTaskBtn = document.getElementById('addTaskBtn');
    const tareaProyectoSelect = document.getElementById('tareaProyecto');
    const tituloInput = document.getElementById('titulo');
    const descripcionInput = document.getElementById('descripcion');
    const estadoSelect = document.getElementById('estado');
    const prioridadSelect = document.getElementById('prioridad');
    const fechaVencimientoInput = document.getElementById('fechaVencimiento');
    const asignadoAInput = document.getElementById('asignadoA');
    const tasksTableBody = document.getElementById('tasksTableBody');
    
    // Cuando hagan click en "Agregar Tarea"
    if (addTaskBtn) {
        addTaskBtn.addEventListener('click', function() {
            
            // Tomar los valores de todos los campos
            const proyectoId = tareaProyectoSelect.value;
            const titulo = tituloInput.value;
            const descripcion = descripcionInput.value;
            const estado = estadoSelect.value;
            const prioridad = prioridadSelect.value;
            const fechaVencimiento = fechaVencimientoInput.value;
            const asignadoA = asignadoAInput.value;
            
            // Verificar que los campos obligatorios no estén vacíos
            if (proyectoId === '' || titulo === '' || descripcion === '') {
                console.log('Por favor completa los campos: Proyecto, Título y Descripción');
                return;
            }
            
            // Crear una nueva tarea con todos los campos
            const nuevaTarea = {
                proyectoId: proyectoId,
                titulo: titulo,
                descripcion: descripcion,
                estado: estado,
                prioridad: prioridad,
                fechaVencimiento: fechaVencimiento,
                asignadoA: asignadoA
            };
            
            // Agregar la tarea al array
            tareas.push(nuevaTarea);
            console.log('Nueva tarea agregada:', nuevaTarea);
            console.log('Total de tareas:', tareas.length);
            
            // Guardar en localStorage
            guardarTareas();
            
            // Mostrar la nueva tarea en la tabla
            mostrarTareas();
            
            // Limpiar todos los campos para escribir otra tarea
            tareaProyectoSelect.selectedIndex = 0; // Seleccionar el primer proyecto
            tituloInput.value = '';
            descripcionInput.value = '';
            estadoSelect.value = 'pendiente';
            prioridadSelect.value = 'baja';
            fechaVencimientoInput.value = '';
            asignadoAInput.value = '';
        });
    }
    
    function guardarTareas() {
        localStorage.setItem('tareasGuardadas', JSON.stringify(tareas));
        console.log('Tareas guardadas en localStorage');
    }
    
    if (tasksTableBody) {
        mostrarTareas();
    }
    
    // Función para mostrar todas las tareas en la tabla
    function mostrarTareas() {
        // Limpiar el contenido actual de la tabla
        tasksTableBody.innerHTML = '';
        
        // Si no hay tareas, mostrar mensaje
        if (tareas.length === 0) {
            tasksTableBody.innerHTML = '<tr><td class="text-muted text-center" colspan="8">No hay tareas agregadas aún</td></tr>';
            return;
        }
        
        // Recorrer todas las tareas y mostrarlas
        for (let i = 0; i < tareas.length; i++) {
            const tarea = tareas[i];
            
            // Buscar el nombre del proyecto
            const nombreProyecto = obtenerNombreProyecto(tarea.proyectoId);
            
            // Crear una nueva fila para la tabla
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>
                    <span class="badge bg-secondary">
                        <i class="fas fa-folder me-1"></i>${nombreProyecto}
                    </span>
                </td>
                <td>${tarea.titulo}</td>
                <td>${tarea.descripcion}</td>
                <td>
                    <span class="badge ${obtenerColorEstado(tarea.estado)}">${tarea.estado}</span>
                </td>
                <td>
                    <span class="badge ${obtenerColorPrioridad(tarea.prioridad)}">${tarea.prioridad}</span>
                </td>
                <td>${tarea.fechaVencimiento || 'Sin fecha'}</td>
                <td>${tarea.asignadoA || 'No asignado'}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="eliminarTarea(${i})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            
            // Hacer la fila arrastrable para drag and drop
            fila.draggable = true;
            fila.addEventListener('dragstart', dragStart);
            fila.addEventListener('dragover', dragOver);
            fila.addEventListener('drop', drop);
            fila.addEventListener('dragend', dragEnd);
            
            // Agregar la fila a la tabla
            tasksTableBody.appendChild(fila);
        }
    }
    
    // Función simple para obtener el nombre del proyecto por su ID
    function obtenerNombreProyecto(proyectoId) {
        for (let i = 0; i < proyectos.length; i++) {
            if (proyectos[i].id === proyectoId) {
                return proyectos[i].nombre;
            }
        }
        return 'Proyecto no encontrado';
    }
    
    // Función simple para obtener color del estado
    function obtenerColorEstado(estado) {
        if (estado === 'pendiente') return 'bg-warning';
        if (estado === 'en_proceso') return 'bg-info';
        if (estado === 'hecha') return 'bg-success';
        return 'bg-secondary';
    }
    
    // Función simple para obtener color de la prioridad
    function obtenerColorPrioridad(prioridad) {
        if (prioridad === 'baja') return 'bg-success';
        if (prioridad === 'media') return 'bg-warning';
        if (prioridad === 'alta') return 'bg-danger';
        return 'bg-secondary';
    }
    
    // Función para eliminar una tarea
    function eliminarTarea(indice) {
        console.log('Eliminando tarea en posición:', indice);
        
        // Eliminar la tarea del array usando el índice
        tareas.splice(indice, 1);
        
        console.log('Tarea eliminada. Total de tareas:', tareas.length);
        
        // Guardar los cambios en localStorage
        guardarTareas();
        
        // Actualizar la tabla para mostrar los cambios
        mostrarTareas();
    }
    
    // Hacer la función eliminarTarea global para que funcione con onclick
    window.eliminarTarea = eliminarTarea;
    
    // ====================
    // FUNCIONALIDAD DRAG AND DROP
    // ====================
    
    // Variable global que guardará la referencia del elemento que se está arrastrando
    let dragSrcEl = null;
    
    /**
     * Evento que se ejecuta cuando comienza a arrastrarse un elemento
     */
    function dragStart(e) {
        // Guarda el elemento que se está arrastrando
        dragSrcEl = this;
        
        // Define que la acción permitida es mover el elemento
        e.dataTransfer.effectAllowed = 'move';
        
        // Guarda el contenido HTML del elemento arrastrado para transferirlo
        e.dataTransfer.setData('text/html', this.innerHTML);
        
        // Agrega una clase CSS para dar un efecto visual de "arrastrando"
        this.classList.add('dragging');
        
        console.log('Iniciando arrastre de tarea');
    }
    
    /**
     * Evento que se ejecuta cuando un elemento arrastrado pasa sobre otro
     */
    function dragOver(e) {
        // Previene el comportamiento por defecto para permitir soltar
        e.preventDefault();
        
        // Indica que la acción será "mover"
        e.dataTransfer.dropEffect = 'move';
    }
    
    /**
     * Evento que se ejecuta cuando un elemento es soltado sobre otro
     */
    function drop(e) {
        // Previene el comportamiento por defecto
        e.preventDefault();
        
        // Si el elemento arrastrado no es el mismo que el destino
        if (dragSrcEl !== this) {
            console.log('Intercambiando tareas...');
            
            // Obtener los índices de las filas intercambiadas
            const filas = Array.from(tasksTableBody.children);
            const indiceSrc = filas.indexOf(dragSrcEl);
            const indiceDest = filas.indexOf(this);
            
            // Intercambiar las tareas en el array
            if (indiceSrc !== -1 && indiceDest !== -1) {
                const tareaTemp = tareas[indiceSrc];
                tareas[indiceSrc] = tareas[indiceDest];
                tareas[indiceDest] = tareaTemp;
                
                // Guardar los cambios en localStorage
                guardarTareas();
                
                // Actualizar la tabla
                mostrarTareas();
                
                console.log('Tareas intercambiadas exitosamente');
            }
        }
    }
    
    /**
     * Evento que se ejecuta cuando termina la acción de arrastrar (se suelte o no)
     */
    function dragEnd() {
        // Quita la clase CSS "dragging" para restaurar el estilo
        this.classList.remove('dragging');
        console.log('Arrastre terminado');
    }
    
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            localStorage.removeItem('usuarioActual');
            console.log('Sesión cerrada, localStorage limpiado');
            
            window.location.href = 'auth.html';
        });
    }
    
});