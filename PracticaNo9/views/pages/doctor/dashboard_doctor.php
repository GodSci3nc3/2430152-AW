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


<ol class="relative border-s border-default">                  
    <li class="mb-10 ms-4">
        <div class="absolute w-3 h-3 bg-neutral-quaternary rounded-full mt-1.5 -start-1.5 border border-buffer"></div>
        <time class="text-sm font-normal leading-none text-body">February 2022</time>
        <h3 class="text-lg font-semibold text-heading my-2">Application UI code in Tailwind CSS</h3>
        <p class="mb-4 text-base font-normal text-body">Get access to over 20+ pages including a dashboard layout, charts, kanban board, calendar, and pre-order E-commerce & Marketing pages.</p>
    </li>
    <li class="mb-10 ms-4">
        <div class="absolute w-3 h-3 bg-neutral-quaternary rounded-full mt-1.5 -start-1.5 border border-buffer"></div>
        <time class="text-sm font-normal leading-none text-body">March 2022</time>
        <h3 class="text-lg font-semibold text-heading my-2">Marketing UI design in Figma</h3>
        <p class="text-base font-normal text-body">All of the pages and components are first designed in Figma and we keep a parity between the two versions even as we update the project.</p>
    </li>
    <li class="ms-4">
        <div class="absolute w-3 h-3 bg-neutral-quaternary rounded-full mt-1.5 -start-1.5 border border-buffer"></div>
        <time class="mb-1 text-sm font-normal leading-none text-body">April 2022</time>
        <h3 class="text-lg font-semibold text-heading my-2">E-Commerce UI code in Tailwind CSS</h3>
        <p class="text-base font-normal text-body">Get started with dozens of web components and interactive elements built on top of Tailwind CSS.</p>
    </li>
</ol>


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