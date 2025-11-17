const loginBtn = document.getElementById('login');

loginBtn.addEventListener('click', function(e) {
    e.preventDefault();

    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;

    $.ajax({
        url: '../../app/models/User/auth.php',
        type: 'POST',
        data: {
            email: email,
            password: password
        },
        success: function(response) {

            console.log('DEBUG:', response);
            
            if(JSON.parse(response).success === false) {
            let message = document.getElementById('systemResponse');

            message.textContent = JSON.parse(response).message;
            message.classList.add('active');

            } else {
                console.log('Redirigiendo a:', JSON.parse(response).redirect);
                window.location.href = JSON.parse(response).redirect;
            }
        },
        error: function() {
            console.log('Error en el ajax de la autenticación')

        }
    })
})