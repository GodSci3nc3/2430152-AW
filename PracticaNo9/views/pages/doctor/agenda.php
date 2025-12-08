<?php
session_start();

if(!isset($_SESSION['username'])){
    Header('Location: ../login.php');
    exit();
} else {
    if($_SESSION['rol'] != 'doctor'){
        Header('Location: /PracticaNo9/views/components/404.html');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda médica - Medicore</title>

    <link rel="icon" href="../../../resources/Medicore Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
                    <h1 class="text-primary-title mb-4">Agenda médica - Bitácora de trabajo</h1>

                    <div id="system-response" class="alert system-response-box"></div>

                    <div class="mb-4">
                        <a href="agendaDetails.php" class="btn-primary">
                            <i class="fa-solid fa-plus"></i> Nueva entrada
                        </a>
                    </div>

                    <table id="agenda" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Módulo</th>
                                <th>Acción realizada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once '../../../app/models/Agenda/getAgenda.php';
                        $agendas = getAgendaByUser($_SESSION['idMedico']);
                        
                        if (!empty($agendas)):
                            foreach($agendas as $agenda): 
                                $fecha = date('d/m/Y H:i', strtotime($agenda['FechaAcceso']));
                        ?>
                            <tr data-agenda-id="<?= $agenda['IdBitacora'] ?>">
                                <td><?= $fecha ?></td>
                                <td><?= $agenda['Modulo'] ?></td>
                                <td><?= substr($agenda['AccionRealizada'], 0, 80) ?>...</td>
                                <td>
                                    <a href="agendaDetails.php?id=<?= $agenda['IdBitacora'] ?>" class="fa-solid fa-eye btn-secondary me-2 icon-btn"></a>
                                    <button class="fa-solid fa-trash btn-secondary deleteBtn"></button>
                                </td>
                            </tr>
                        <?php 
                            endforeach;
                        endif;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="../../js/agenda.js"></script>
    <script src="../../../app/controllers/agendaController.js"></script>
</body>
</html>
