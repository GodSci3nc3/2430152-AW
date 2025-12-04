<?php

session_start();

if(!isset($_SESSION['username'])){

    Header('Location: ../login.php');
} else {
    if($_SESSION['rol'] != 'doctor'){
        Header('Location: /PracticaNo9/views/components/404.html');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    

    <link rel="icon" href="../../../resources/Medicore Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../styles/globalStyles.css">
    <link rel="stylesheet" href="../../styles/dashboard.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://kit.fontawesome.com/aad8366bcb.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js "></script>


    <title>Dashboard | Medicore System</title>
</head>
<body>

    <div class="container-fluid">
        <div class="row">

        <div class="col-md-3 d-md-block">

        <?php
        require '../../components/sidebar.php'
        ?>


        </div>

        <div class="col-md-9 mainContent">


    <div class="container-fluid pt-5">
            <div id="welcome-message" class="welcome-screen">
            <h1 class="text-primary-title">Bienvenido, <?php echo $_SESSION['username']?></h1>
        </div>

        <div class="row">
        <div class="col">
        <h1 class="text-primary-title">Agenda de hoy</h1>
        <hr>

        <?php
        if (isset($_SESSION['idMedico'])) {
            require_once '../../../app/models/Appointments/getAppointments.php';
            $todayAppointments = getTodayAppointments($_SESSION['idMedico']);
            
            if (empty($todayAppointments)): ?>
                <p class="text-primary-p" style="color: var(--color-text-light);">No hay citas programadas para hoy.</p>
            <?php else: ?>

<ol class="relative border-s" style="border-color: var(--color-border);">
    <?php foreach($todayAppointments as $appointment): 
        $fecha = new DateTime($appointment['FechaCita']);
    ?>                  
    <li class="mb-4 ms-4">
        <div class="position-absolute rounded-circle" style="width: 12px; height: 12px; background-color: var(--color-primary); margin-top: 6px; margin-left: -22px; border: 2px solid var(--color-white);"></div>
        <time class="small" style="color: var(--color-text-light);"><?= $fecha->format('H:i') ?></time>
        <h3 class="text-primary-subtitle my-2"><?= $appointment['PatientName'] ?></h3>
        <p class="mb-3" style="color: var(--color-text-light);"><?= $appointment['MotivoConsulta'] ?></p>
    </li>
    <?php endforeach; ?>
</ol>

            <?php endif; 
        } else { ?>
            <p class="text-primary-p" style="color: var(--color-text-light);">Error: Sesión de médico no encontrada.</p>
        <?php } ?>


        </div>

        <div class="col">
            <h1 class="text-primary-title">Agenda de la semana</h1>
            <hr>

            <div id="agenda">

            </div>
        </div>

        </div>

    </div>
    </div>

    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script src="../../js/dashboard_doctor.js"></script>
</body>
</html>