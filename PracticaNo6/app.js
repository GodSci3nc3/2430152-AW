// Esperamos que la página cargue completamente
document.addEventListener('DOMContentLoaded', function() {
    
    // Lógica de usuarios
    let usuarios = [];
    
    const usuariosGuardados = localStorage.getItem('usuariosRegistrados');
    if (usuariosGuardados) {
        usuarios = JSON.parse(usuariosGuardados);
        console.log('Usuarios cargados:', usuarios.length);
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
            
            usuarios.push(nuevoUsuario);
            guardarUsuarios();
            
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
            
            let usuarioEncontrado = null;
            for (let i = 0; i < usuarios.length; i++) {
                if (usuarios[i].email === email && usuarios[i].password === password) {
                    usuarioEncontrado = usuarios[i];
                    break;
                }
            }
            
            if (usuarioEncontrado) {
                localStorage.setItem('usuarioActual', JSON.stringify(usuarioEncontrado));
                console.log('Login exitoso');
                window.location.href = 'dashboard.html';
            } else {
                console.log('Email o contraseña incorrectos');
            }
        });
    }
    
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
        
        setTimeout(() => {
            welcomeTitle.classList.add('moved');
        }, 600);
        
        inicializarSistema(usuario);
    }
    
    function inicializarSistema(usuario) {
        let proyectos = [];
        let tareas = [];
        let dragSrcEl = null;
        
        const proyectosGuardados = localStorage.getItem('proyectosGuardados');
        if (proyectosGuardados) {
            const todosLosProyectos = JSON.parse(proyectosGuardados);
            proyectos = todosLosProyectos.filter(p => p.creadoPor === usuario.nombre);
        }

        if (proyectos.length === 0) {
            proyectos.push({
                id: 'PROJ-001',
                nombre: 'Sin nombre',
                indice: 0,
                creadoPor: usuario.nombre
            });
            guardarProyectos();
        }

        const tareasGuardadas = localStorage.getItem('tareasGuardadas');
        if (tareasGuardadas) {
            const todasLasTareas = JSON.parse(tareasGuardadas);
            tareas = todasLasTareas.filter(t => t.asignadoA === usuario.nombre);
        }        function guardarProyectos() {
            const proyectosExistentes = localStorage.getItem('proyectosGuardados');
            let todosLosProyectos = proyectosExistentes ? JSON.parse(proyectosExistentes) : [];
            
            todosLosProyectos = todosLosProyectos.filter(p => p.creadoPor !== usuario.nombre);
            todosLosProyectos = todosLosProyectos.concat(proyectos);
            
            localStorage.setItem('proyectosGuardados', JSON.stringify(todosLosProyectos));
        }

        function guardarTareas() {
            const tareasExistentes = localStorage.getItem('tareasGuardadas');
            let todasLasTareas = tareasExistentes ? JSON.parse(tareasExistentes) : [];
            
            todasLasTareas = todasLasTareas.filter(t => t.asignadoA !== usuario.nombre);
            todasLasTareas = todasLasTareas.concat(tareas);
            
            localStorage.setItem('tareasGuardadas', JSON.stringify(todasLasTareas));
        }
        
        const createProjectBtn = document.getElementById('createProjectBtn');
        if (createProjectBtn) {
            createProjectBtn.addEventListener('click', function() {
                const nuevoId = 'PROJ-' + String(proyectos.length + 1).padStart(3, '0');
                const nuevoProyecto = {
                    id: nuevoId,
                    nombre: 'Nuevo Proyecto',
                    indice: proyectos.length,
                    creadoPor: usuario.nombre
                };
                
                proyectos.push(nuevoProyecto);
                guardarProyectos();
                mostrarTodo();
                cargarProyectosEnDropdown();
            });
        }
        
        const addTaskBtn = document.getElementById('addTaskBtn');
        if (addTaskBtn) {
            addTaskBtn.addEventListener('click', function() {
                const titulo = document.getElementById('titulo').value;
                const descripcion = document.getElementById('descripcion').value;
                const proyectoId = document.getElementById('tareaProyecto').value;
                const estado = document.getElementById('estado').value;
                const prioridad = document.getElementById('prioridad').value;
                const fechaVencimiento = document.getElementById('fechaVencimiento').value;
                
                if (!titulo || !descripcion) {
                    console.log('Por favor completa título y descripción');
                    return;
                }
                
                const nuevaTarea = {
                    titulo: titulo,
                    descripcion: descripcion,
                    proyectoId: proyectoId || proyectos[0].id,
                    estado: estado,
                    prioridad: prioridad,
                    fechaVencimiento: fechaVencimiento,
                    asignadoA: usuario.nombre,
                    indice: tareas.filter(t => t.proyectoId === (proyectoId || proyectos[0].id)).length
                };
                
                tareas.push(nuevaTarea);
                guardarTareas();
                mostrarTodo();
                
                document.getElementById('titulo').value = '';
                document.getElementById('descripcion').value = '';
                document.getElementById('estado').value = 'pendiente';
                document.getElementById('prioridad').value = 'baja';
                document.getElementById('fechaVencimiento').value = '';
            });
        }
        
        function cargarProyectosEnDropdown() {
            const tareaProyectoSelect = document.getElementById('tareaProyecto');
            if (tareaProyectoSelect) {
                tareaProyectoSelect.innerHTML = '';
                for (let i = 0; i < proyectos.length; i++) {
                    const option = document.createElement('option');
                    option.value = proyectos[i].id;
                    option.textContent = proyectos[i].nombre;
                    tareaProyectoSelect.appendChild(option);
                }
            }
        }
        
        function mostrarTodo() {
            const tbody = document.getElementById('mainTableBody');
            tbody.innerHTML = '';
            
            if (proyectos.length === 0) {
                const emptyTemplate = document.getElementById('emptyStateTemplate');
                const emptyRow = emptyTemplate.content.cloneNode(true);
                tbody.appendChild(emptyRow);
                return;
            }
            
            for (let i = 0; i < proyectos.length; i++) {
                const proyecto = proyectos[i];
                
                const projectTemplate = document.getElementById('projectRowTemplate');
                const filaProyecto = projectTemplate.content.cloneNode(true).querySelector('tr');
                const projectNameElement = filaProyecto.querySelector('.project-name');
                projectNameElement.textContent = proyecto.nombre;
                projectNameElement.setAttribute('data-project-id', proyecto.id);
                
                const deleteProjectBtn = filaProyecto.querySelector('.project-delete');
                deleteProjectBtn.onclick = function() {
                    eliminarProyecto(proyecto.id);
                };
                
                filaProyecto.addEventListener('dragstart', dragStartProject);
                filaProyecto.addEventListener('dragover', dragOver);
                filaProyecto.addEventListener('drop', dropProject);
                filaProyecto.addEventListener('dragend', dragEnd);
                
                projectNameElement.addEventListener('blur', function() {
                    const projectId = this.getAttribute('data-project-id');
                    const nuevoNombre = this.textContent.trim();
                    
                    for (let j = 0; j < proyectos.length; j++) {
                        if (proyectos[j].id === projectId) {
                            proyectos[j].nombre = nuevoNombre;
                            break;
                        }
                    }
                    guardarProyectos();
                    cargarProyectosEnDropdown();
                });
                
                tbody.appendChild(filaProyecto);
                
                const tareasDelProyecto = tareas.filter(t => t.proyectoId === proyecto.id);
                for (let j = 0; j < tareasDelProyecto.length; j++) {
                    const tarea = tareasDelProyecto[j];
                    
                    const taskTemplate = document.getElementById('taskRowTemplate');
                    const filaTarea = taskTemplate.content.cloneNode(true).querySelector('tr');
                    
                    filaTarea.querySelector('.task-title').textContent = tarea.titulo;
                    filaTarea.querySelector('.task-description').textContent = tarea.descripcion;
                    filaTarea.querySelector('.task-status').textContent = tarea.estado;
                    filaTarea.querySelector('.task-status').className = `badge ${obtenerColorEstado(tarea.estado)}`;
                    filaTarea.querySelector('.task-priority').textContent = tarea.prioridad;
                    filaTarea.querySelector('.task-priority').className = `badge ${obtenerColorPrioridad(tarea.prioridad)}`;
                    filaTarea.querySelector('.task-date').textContent = tarea.fechaVencimiento || '-';
                    
                    const deleteBtn = filaTarea.querySelector('.task-delete');
                    deleteBtn.onclick = function() {
                        eliminarTarea(proyecto.id, j);
                    };
                    
                    filaTarea.addEventListener('dragstart', dragStartTask);
                    filaTarea.addEventListener('dragover', dragOver);
                    filaTarea.addEventListener('drop', dropTask);
                    filaTarea.addEventListener('dragend', dragEnd);
                    
                    tbody.appendChild(filaTarea);
                }
            }
        }
        
        function obtenerColorEstado(estado) {
            if (estado === 'pendiente') return 'bg-warning';
            if (estado === 'en_proceso') return 'bg-info';
            if (estado === 'hecha') return 'bg-success';
            return 'bg-secondary';
        }
        
        function obtenerColorPrioridad(prioridad) {
            if (prioridad === 'baja') return 'bg-success';
            if (prioridad === 'media') return 'bg-warning';
            if (prioridad === 'alta') return 'bg-danger';
            return 'bg-secondary';
        }
        
        function dragStartProject(e) {
            dragSrcEl = this;
            e.dataTransfer.effectAllowed = 'move';
            this.classList.add('dragging');
        }
        
        function dragStartTask(e) {
            dragSrcEl = this;
            e.dataTransfer.effectAllowed = 'move';
            this.classList.add('dragging');
        }
        
        function dragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
        }
        
        function dropProject(e) {
            e.preventDefault();
            if (dragSrcEl !== this && dragSrcEl.classList.contains('project-header')) {
                const filas = Array.from(document.querySelectorAll('.project-header'));
                const indiceSrc = filas.indexOf(dragSrcEl);
                const indiceDest = filas.indexOf(this);
                
                if (indiceSrc !== -1 && indiceDest !== -1) {
                    const proyectoTemp = proyectos[indiceSrc];
                    proyectos[indiceSrc] = proyectos[indiceDest];
                    proyectos[indiceDest] = proyectoTemp;
                    
                    guardarProyectos();
                    mostrarTodo();
                }
            }
        }
        
        function dropTask(e) {
            e.preventDefault();
            if (dragSrcEl !== this && dragSrcEl.classList.contains('task-row') && this.classList.contains('task-row')) {
                const proyectoSrc = encontrarProyectoDeTarea(dragSrcEl);
                const proyectoDest = encontrarProyectoDeTarea(this);
                
                if (proyectoSrc === proyectoDest) {
                    const tareasDelProyecto = tareas.filter(t => t.proyectoId === proyectoSrc);
                    
                    const filasDelProyecto = [];
                    const todasLasFilas = Array.from(document.querySelectorAll('.task-row'));
                    
                    for (let i = 0; i < todasLasFilas.length; i++) {
                        const filaActual = todasLasFilas[i];
                        const proyectoActual = encontrarProyectoDeTarea(filaActual);
                        if (proyectoActual === proyectoSrc) {
                            filasDelProyecto.push(filaActual);
                        }
                    }
                    
                    const indiceSrcEnProyecto = filasDelProyecto.indexOf(dragSrcEl);
                    const indiceDestEnProyecto = filasDelProyecto.indexOf(this);
                    
                    if (indiceSrcEnProyecto !== -1 && indiceDestEnProyecto !== -1) {
                        const tareaTemp = tareasDelProyecto[indiceSrcEnProyecto];
                        tareasDelProyecto[indiceSrcEnProyecto] = tareasDelProyecto[indiceDestEnProyecto];
                        tareasDelProyecto[indiceDestEnProyecto] = tareaTemp;
                        
                        for (let i = 0; i < tareas.length; i++) {
                            if (tareas[i].proyectoId === proyectoSrc) {
                                const indiceEnProyecto = tareasDelProyecto.findIndex(t => 
                                    t.titulo === tareas[i].titulo && 
                                    t.descripcion === tareas[i].descripcion
                                );
                                if (indiceEnProyecto !== -1) {
                                    tareas[i] = tareasDelProyecto[indiceEnProyecto];
                                }
                            }
                        }
                        
                        guardarTareas();
                        mostrarTodo();
                    }
                }
            }
        }
        
        function dragEnd() {
            this.classList.remove('dragging');
        }
        
        function encontrarProyectoDeTarea(filaTarea) {
            let fila = filaTarea.previousElementSibling;
            while (fila && !fila.classList.contains('project-header')) {
                fila = fila.previousElementSibling;
            }
            return fila ? fila.querySelector('[data-project-id]').getAttribute('data-project-id') : null;
        }
        
        function obtenerTareasDelProyecto(proyectoId) {
            return tareas.filter(t => t.proyectoId === proyectoId);
        }
        
        window.eliminarTarea = function(proyectoId, indiceLocal) {
            const tareasDelProyecto = tareas.filter(t => t.proyectoId === proyectoId);
            const tareaAEliminar = tareasDelProyecto[indiceLocal];
            
            const indiceGlobal = tareas.indexOf(tareaAEliminar);
            if (indiceGlobal !== -1) {
                tareas.splice(indiceGlobal, 1);
                guardarTareas();
                mostrarTodo();
            }
        };

        window.eliminarProyecto = function(proyectoId) {
            const indice = proyectos.findIndex(p => p.id === proyectoId);
            if (indice !== -1) {
                proyectos.splice(indice, 1);
                tareas = tareas.filter(t => t.proyectoId !== proyectoId);
                
                guardarProyectos();
                guardarTareas();
                mostrarTodo();
                cargarProyectosEnDropdown();
            }
        };
        
        cargarProyectosEnDropdown();
        mostrarTodo();
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