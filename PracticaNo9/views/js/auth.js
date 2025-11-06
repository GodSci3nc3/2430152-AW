document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    const response = document.getElementById('systemResponse');

    if (!email || !password) {
        response.textContent = 'Por favor complete todos los campos';
        response.classList.add('active');

        
    } else {

        (email === 'admin@admin.com' && password === 'admin') 
        ? window.location.href = 'dashboard.html' 
        : (response.textContent = 'Parece que ese usuario no existe. Prueba creando una cuenta.', response.classList.add('active'));

    }


});

