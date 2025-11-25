<?php 
session_start();

if(isset($_SESSION['rol'])) {
    switch ($_SESSION['rol']){
        case 'admin': Header('Location: admin/dashboard_admin.php'); break;
        case 'doctor': Header('Location: doctor/dashboard_doctor.php'); break;
        case 'receptionist': Header('Location: receptionist/dashboard_receptionist.php'); break;
    }

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
   <link rel="stylesheet" href="../styles/globalStyles.css">

    <script src="https://kit.fontawesome.com/aad8366bcb.js" crossorigin="anonymous"></script>
   
    
    <title> Inicia sesión | Medicore System </title>
</head>
<body>

    
   <div class="container mt-5 vh-100 d-flex align-items-center">
       <div class="row justify-content-center w-100">
           <div class="col-md-5"> 
           
               <div class="">
                   <div class="d-flex align-items-center justify-content-center mb-4">
                       <img class = "logo-header" src="../../resources/Medicore Logo.png" alt="">
                       <p class = "text-primary-title mb-0">Medicore System</p>
                   </div>
                   <h2 class="mb-3 fw-bold">Inicia sesión</h2>

                   <div class="systemResponse text-center">
                        <p class="systemResponse disabled" id="systemResponse">Respuesta del sistema</p>
                   </div>
                   <form id="loginForm">

                       <label class="mb-3" for="username">Nombre de Usuario</label>
                       <input class = "form-control mb-3" name="username" id="loginUsername" type="email">


                       <label class="mb-3" for="password">Contraseña</label>
                       <input class = "form-control mb-5" name="password" id="loginPassword" type="password">

                       <div class="d-grid text-center">
                            <button id = "login" class="btn-primary mb-5 p-2" type="submit">Iniciar sesión</button>

                        </div>

                    </form>
               </div>
               
           </div>
       </div>
   </div>

   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="../../app/controllers/authController.js"></script>

</body>
</html>