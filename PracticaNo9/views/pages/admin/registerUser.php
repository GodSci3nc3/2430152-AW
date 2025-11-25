<?php 
session_start();

if(isset($_SESSION['rol'])) {
    if(!$_SESSION['rol'] == 'admin') {
        Header('Location: ../login.php');
    }

} else {
    Header('Location: ../login.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../resources/Medicore Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../../styles/globalStyles.css">

    <script src="https://kit.fontawesome.com/aad8366bcb.js" crossorigin="anonymous"></script>
   
    
    <title> Registrar usuario | Medicore System </title>
</head>
<body>


    <div class="container-fluid">

    <div class="row">

    <div class="col-md-3">

        <?php
        require '../../components/sidebar.php'
        ?>


    </div>

    <div class="col-md-9">

    
   <div class="container vh-100 d-flex align-items-center">
       <div class="row justify-content-center w-100">
           <div class="col-md-5"> 
           
               <div class="">
                   <div class="d-flex align-items-center justify-content-center mb-4">
                       <img class = "logo-header" src="../../../resources/Medicore Logo.png" alt="">
                       <p class = "text-primary-title mb-0">Medicore System</p>
                   </div>
                   <h2 class="mb-3 fw-bold">Registrar nuevo usuario</h2>

                   <div class="systemResponse text-center">
                        <p class="systemResponse disabled" id="systemResponse">Respuesta del sistema</p>
                   </div>
                   <form id="loginForm">

                       <label class="mb-3" for="username">Nombre de Usuario</label>
                       <input class = "form-control mb-3" name="username" id="registerUsername" type="text">

                       <label class="mb-3" for="email">Correo electrónico</label>
                       <input class = "form-control mb-3" name="email" id="registerEmail" type="email">

                       <label class="mb-3" for="email">Rol de usuario</label>
                       <select class = "form-control mb-3" name="rol" id="registerRol">
                        <option value="doctor">Médico</option>
                        <option value="recepcionista">Recepcionista</option>
                       </select>

                       <label class="mb-3" for="password">Contraseña</label>
                       <input class = "form-control mb-5" name="password" id="registerPassword" type="password">

                       <div class="d-grid text-center">
                            <button id = "register" class="btn-primary mb-5 p-2" type="submit">Registrar</button>

                        </div>

                    </form>
               </div>
               
           </div>
       </div>
   </div>

   </div>

   </div>

   </div>

   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="../../../app/controllers/authController.js"></script>

</body>
</html>