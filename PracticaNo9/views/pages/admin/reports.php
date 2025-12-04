<?php
session_start();
require_once '../../../app/helpers/permissions.php';

if(!isset($_SESSION['username'])){
    Header('Location: ../login.php');
} else {
    if($_SESSION['rol'] != 'admin'){
        Header('Location: /PracticaNo9/views/components/404.html');
    }
}

// Obtener reportes
$reportResult = json_decode(file_get_contents('http://localhost/PracticaNo9/app/models/Reports/getReports.php'), true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Medicore</title>

    <link rel="icon" href="../../../resources/Medicore Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/globalStyles.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="https://kit.fontawesome.com/aad8366bcb.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 d-md-block">
                <?php require '../../components/sidebar.php';?>
            </div>

            <div class="col-md-9">
                <div class="container-fluid p-5">
                    
                    <div class="systemResponse">
                        <p id="systemResponse" class="systemResponse disabled">Respuesta del sistema</p>
                    </div>

                    <h1 class="text-primary-title">Reportes Generados</h1>
                    <p class="text-secondary-title mb-4">Gestión de reportes PDF y Excel del sistema</p>

                    <table id="reportsTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Paciente</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th>Generado Por</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($reportResult && $reportResult['success']) {
                            foreach ($reportResult['data'] as $reporte) {
                                $icon = $reporte['TipoReporte'] === 'PDF' ? 'fa-file-pdf text-danger' : 'fa-file-excel text-success';
                                $fecha = date('d/m/Y H:i', strtotime($reporte['FechaGeneracion']));
                                echo "<tr>";
                                echo "<td>{$reporte['IdReporte']}</td>";
                                echo "<td><i class='fa-solid {$icon}'></i> {$reporte['TipoReporte']}</td>";
                                echo "<td>{$reporte['NombrePaciente']}</td>";
                                echo "<td>{$reporte['Descripcion']}</td>";
                                echo "<td>{$fecha}</td>";
                                echo "<td>{$reporte['GeneradoPor']}</td>";
                                echo "<td><button class='btn-icon-delete' onclick='deleteReport({$reporte['IdReporte']})'><i class='fa-solid fa-trash'></i></button></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="../../js/sidebar.js"></script>
    <script src="../../js/reports.js"></script>
</body>
</html>
