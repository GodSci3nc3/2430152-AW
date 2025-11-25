document.getElementById('logout').addEventListener('click', function(e) {
    e.preventDefault();

    $.ajax({
        url: '/PracticaNo9/app/models/User/logout.php',
        type: 'POST',

        success: function() {
            console.log('Session destroy')
            window.location.href = '/PracticaNo9/views/pages/login.php';    
        },
        error: function() {
            console.log('Error while user logout')
        }

    })
});