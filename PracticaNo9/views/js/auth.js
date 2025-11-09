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
        ? window.location.href = 'admin/dashboard_admin.html' 
        : (response.textContent = 'Parece que ese usuario no existe. Comunícate con director de área para llevar registro de tu cuenta.', response.classList.add('active'));

    }


});

