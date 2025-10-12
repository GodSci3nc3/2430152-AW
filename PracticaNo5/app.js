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
    

    let tareas = [];
    
    const tareasGuardadas = localStorage.getItem('tareasGuardadas');
    if (tareasGuardadas) {
        tareas = JSON.parse(tareasGuardadas);
        console.log('Tareas cargadas del localStorage:', tareas.length);
    }
    
    const addTaskBtn = document.getElementById('addTaskBtn');
    const taskNameInput = document.getElementById('taskName');
    const taskDescriptionInput = document.getElementById('taskDescription');
    const tasksTableBody = document.getElementById('tasksTableBody');
    
    if (addTaskBtn) {
        addTaskBtn.addEventListener('click', function() {
            
            const nombreTarea = taskNameInput.value;
            const descripcionTarea = taskDescriptionInput.value;
            
            if (nombreTarea === '' || descripcionTarea === '') {
                console.log('Por favor completa ambos campos');
                return;
            }
            
            const nuevaTarea = {
                nombre: nombreTarea,
                descripcion: descripcionTarea
            };
            
            tareas.push(nuevaTarea);
            console.log('Nueva tarea agregada:', nuevaTarea);
            console.log('Total de tareas:', tareas.length);
            
            guardarTareas();
            
            mostrarTareas();
            
            taskNameInput.value = '';
            taskDescriptionInput.value = '';
        });
    }
    
    function guardarTareas() {
        localStorage.setItem('tareasGuardadas', JSON.stringify(tareas));
        console.log('Tareas guardadas en localStorage');
    }
    
    if (tasksTableBody) {
        mostrarTareas();
    }
    
    function mostrarTareas() {
        tasksTableBody.innerHTML = '';
        
        if (tareas.length === 0) {
            tasksTableBody.innerHTML = '<tr><td class="text-muted text-center" colspan="2">No hay tareas agregadas aún</td></tr>';
            return;
        }
        
        for (let i = 0; i < tareas.length; i++) {
            const tarea = tareas[i];
            
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${tarea.nombre}</td>
                <td>${tarea.descripcion}</td>
            `;
            
            tasksTableBody.appendChild(fila);
        }
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