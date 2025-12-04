<?php

session_start();

if(!isset($_SESSION['username'])){
    Header('Location: ../login.php');
} else {
    if($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'receptionist'){
        Header('Location: /PracticaNo9/views/components/404.html');
    }
}

$feeId = $_GET['id'] ?? null;
if (!$feeId) {
    Header('Location: fees_and_payments.php');
}

require_once '../../../app/models/Fees/getFees.php';
require_once '../../../app/models/Specialties/getSpecialties.php';

$fees = getFees();
$fee = null;
foreach($fees as $f) {
    if($f['IdTarifa'] == $feeId) {
        $fee = $f;
        break;
    }
}

if (!$fee) {
    Header('Location: fees_and_payments.php');
}

$specialties = getSpecialties();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de tarifa - Medicore</title>

    <link rel="icon" href="../../../resources/Medicore Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/globalStyles.css">

    <script src="https://kit.fontawesome.com/aad8366bcb.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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

        <h1 class="text-primary-title mb-4">Detalles de tarifa</h1>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="text-primary-subtitle">Información de la tarifa</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Descripción del servicio</label>
                            <input type="text" class="form-control" data-field="DescripcionServicio" value="<?= $fee['DescripcionServicio'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Costo base</label>
                            <input type="number" step="0.01" class="form-control" data-field="CostoBase" value="<?= $fee['CostoBase'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Especialidad</label>
                            <select class="form-control" data-field="EspecialidadId">
                                <?php foreach($specialties as $specialty): ?>
                                    <option value="<?= $specialty['IdEspecialidad'] ?>" 
                                        <?php if($fee['NombreEspecialidad'] == $specialty['NombreEspecialidad']) { echo 'selected'; } ?>>
                                        <?= $specialty['NombreEspecialidad'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-control" data-field="Estatus">
                                <option value="1" <?php if($fee['Estatus'] == 1) { echo 'selected'; } ?>>Activo</option>
                                <option value="0" <?php if($fee['Estatus'] == 0) { echo 'selected'; } ?>>Inactivo</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <a href="fees_and_payments.php" class="btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>Volver a tarifas
        </a>

    </div>

    </div>

    </div>
    </div>

    <script>
    const feeId = <?= $feeId ?>;
    const message = document.getElementById('systemResponse');

    document.querySelectorAll('input[data-field], select[data-field]').forEach(field => {
        field.addEventListener('change', function() {
            const column = this.dataset.field;
            const value = this.value;

            $.ajax({
                url: '../../../app/models/Fees/updateFee.php',
                type: 'POST',
                data: {
                    idFee: feeId,
                    column: column,
                    change: value
                },
                success: function() {
                    message.textContent = 'Cambio guardado';
                    message.classList.add('active');
                    setTimeout(() => {
                        message.classList.remove('active');
                    }, 2000);
                },
                error: function() {
                    message.textContent = 'Error al guardar';
                    message.classList.add('active');
                }
            });
        });
    });
    </script>
</body>
</html>
