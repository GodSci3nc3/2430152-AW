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

        <div class="timeline">
            <div class="appointment-item">
                <div class="hour">09:00</div>
                <div class="info">María Gonzalez - Consulta general</div>
            </div>

            <div class="appointment-item">
                <div class="hour">09:00</div>
                <div class="info">María Gonzalez - Consulta general</div>
            </div>

            <div class="appointment-item">
                <div class="hour">09:30</div>
                <div class="info">María Gonzalez - Consulta general</div>
            </div>

            <div class="appointment-item">
                <div class="hour">10:00</div>
                <div class="info">María Gonzalez - Consulta general</div>
            </div>
        </div>
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

    <script src="../../js/dashboard_doctor.js"></script>
</body>
</html>