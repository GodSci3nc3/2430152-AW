const loginBtn = document.getElementById('login');
const userData = document.querySelectorAll('td[contenteditable = "true"]')
const deleteUserBtn = document.querySelectorAll('.deleteBtn')
const registerUserBtn = document.getElementById('register')

if (loginBtn) {
loginBtn.addEventListener('click', function(e) {
    e.preventDefault();

    const username = document.getElementById('loginUsername').value;
    const password = document.getElementById('loginPassword').value;

    $.ajax({
        url: '../../app/models/User/auth.php',
        type: 'POST',
        data: {
            username: username,
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
});
}

if (registerUserBtn) {
registerUserBtn.addEventListener('click', function(e) {
    e.preventDefault();

    const username = document.getElementById('registerUsername').value;
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;
    const rol = document.getElementById('registerRol').value;

    $.ajax({
        url: '/PracticaNo9/app/models/User/createUser.php',
        type: 'POST',
        data: {
            username: username,
            email: email,
            password: password,
            rol: rol
        }
    })
});
}

userData.forEach(data => {
    data.addEventListener('blur', function() {

        const idUser = this.closest('tr').dataset.userId;
        const column = this.dataset.field;
        const value = this.textContent;

        $.ajax({
            url: '../../../app/models/User/updateUser.php',
            type: 'POST',
            data: {
                idUser: idUser,
                column: column,
                change: value
            },
            error: function() {
                console.log('Error in ajax about update user')
            }
        })

    })
})


deleteUserBtn.forEach(deleteButton => {
    deleteButton.addEventListener('click', function() {

        const idUser = this.closest('tr').dataset.patientId;
        const patient = this.closest('tr');

        $.ajax({
            url: '../../../app/models/User/deleteUser.php',
            type: 'POST',
            data: {
                IdUser: idUser
            },
            success: function() {
                patient.remove();
            },
            error: function() {
                console.log('Error in ajax to delete User')
            }
        })
    })

})

