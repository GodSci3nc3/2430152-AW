// Esperamos que la página cargue completamente
document.addEventListener('DOMContentLoaded', function() {
    
    let usuarios = [];
    
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
            
            const usuarioGuardado = localStorage.getItem('usuarioActual');
            if (usuarioGuardado) {
                const usuario = JSON.parse(usuarioGuardado);
                
                if (usuario.email === email && usuario.password === password) {
                    console.log('Login exitoso');
                    window.location.href = 'dashboard.html';
                } else {
                    console.log('Email o contraseña incorrectos');
                }
            } else {
                console.log('No hay usuarios registrados');
            }
        });
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
    
    // Botón de cerrar sesión
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