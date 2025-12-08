<?php

session_start();

if(!isset($_SESSION['username'])){

    Header('Location: ../login.php');
} else {
    if($_SESSION['rol'] != 'admin'){
        Header('Location: /PracticaNo9/views/components/404.html');
    }
}

require_once '../../../app/models/Dashboard/getTotalIngresos.php';
require_once '../../../app/models/Dashboard/getIngresosPorEspecialidad.php';
require_once '../../../app/models/Dashboard/getIngresosMensuales.php';
require_once '../../../app/models/Dashboard/getGastos.php';

$totalIngresos = getTotalIngresos();
$gastos = getGastos($totalIngresos);
$utilidad = $totalIngresos - $gastos['total'];
$ingresosPorEspecialidad = getIngresosPorEspecialidad();
$ingresosMensuales = getIngresosMensuales();

// Debug: verificar datos
error_log("Ingresos mensuales: " . json_encode($ingresosMensuales));

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
            <div id="welcome-message" class="welcome-screen">
            <h1 class="text-primary-title">Bienvenido, Dr. Mario</h1>
        </div>

        <div class="container-fluid p-5" id="main-content">

            <h1 class="text-primary-title">Estado financiero de la empresa</h1> <hr>
            <div class="row">
            <div class="col">
            <div class="row text-center justify-content-center">
                <div class="row">
                    <div class="col">
                        <h3 class="text-primary-subtitle">Ingresos totales</h3>
                        <p class="text-primary-p">$<?php echo number_format($totalIngresos, 2); ?></p>
                    </div>

                    <div class="col">
                        <h3 class="text-primary-subtitle">Gastos</h3>
                        <p class="text-primary-p">$<?php echo number_format($gastos['total'], 2); ?></p>
                        <small class="text-muted">Fijos: $<?php echo number_format($gastos['fijos'], 2); ?> | Variables: $<?php echo number_format($gastos['variables'], 2); ?></small>
                    </div>
                    
                    <div class="col">
                        <h3 class="text-primary-subtitle">Utilidad o pérdida</h3>
                        <p class="text-primary-p" style="color: <?php echo $utilidad >= 0 ? '#28a745' : '#dc3545'; ?>">
                            <?php echo $utilidad >= 0 ? '+' : ''; ?>$<?php echo number_format($utilidad, 2); ?>
                        </p>
                        <small class="text-muted"><?php echo $utilidad >= 0 ? 'Utilidad' : 'Pérdida'; ?></small>
                    </div>

                <div class="row align-items-center graph">
                    <canvas id="topSpecialty">
                </div>
                    
                </div>
            </div>
            </div>

            <div class="col">
                <div class="row text-center justify-content-center graph">
                    <canvas id="monthIncomes">

                </div>
            </div>
        </div>
        </div>
        </div>

        </div>

        </div>


        <script>
        const ingresosPorEspecialidad = <?php echo json_encode($ingresosPorEspecialidad); ?>;
        const ingresosMensuales = <?php echo json_encode($ingresosMensuales); ?>;
        console.log('Datos recibidos:');
        console.log('ingresosMensuales:', ingresosMensuales);
        console.log('ingresosPorEspecialidad:', ingresosPorEspecialidad);
        </script>
        <script src="../../js/dashboard_admin.js"></script>
</body>
</html>