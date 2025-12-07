<?php
session_start();
require_once '../../../app/helpers/permissions.php';

if(!isset($_SESSION['username'])){
    Header('Location: ../login.php');
    exit();
}

checkPermission('tarifas');

$paymentResult = json_decode(file_get_contents('http://localhost/PracticaNo9/app/models/Payments/getPayments.php'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos y tarifas en Medicore</title>


    <link rel="icon" href="../../../resources/Medicore Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/globalStyles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://kit.fontawesome.com/aad8366bcb.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 d-md-block ">
            <?php require '../../components/sidebar.php';?>

            </div>

            <div class="col-md-9">


    <div class="container-fluid p-5">
        <h1 class="text-primary-title mb-4">Pagos y tarifas en Medicore</h1>

        <h3 class="text-primary-subtitle mb-3">Pagos Generados</h3>
        <table id="paymentsTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID Pago</th>
                    <th>Paciente</th>
                    <th>Fecha Cita</th>
                    <th>Médico</th>
                    <th>Especialidad</th>
                    <th>Servicio</th>
                    <th>Monto</th>
                    <th>Método Pago</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($paymentResult && $paymentResult['success']): ?>
                <?php foreach ($paymentResult['data'] as $pago): ?>
                    <?php 
                        $fecha = $pago['FechaCita'] ? date('d/m/Y H:i', strtotime($pago['FechaCita'])) : 'N/A';
                        $servicio = $pago['DescripcionServicio'] ?? 'Consulta general';
                    ?>
                    <tr data-payment-id="<?= $pago['IdPago'] ?>">
                        <td><?= $pago['IdPago'] ?></td>
                        <td><?= $pago['NombrePaciente'] ?></td>
                        <td><?= $fecha ?></td>
                        <td><?= $pago['NombreMedico'] ?></td>
                        <td><?= $pago['NombreEspecialidad'] ?></td>
                        <td><?= $servicio ?></td>
                        <td>$<?= number_format($pago['Monto'], 2) ?></td>
                        <td>
                            <?php if ($pago['MetodoPago'] === 'Pendiente'): ?>
                                <select class="form-select form-select-sm payment-method" data-id="<?= $pago['IdPago'] ?>">
                                    <option value="Pendiente" selected>Pendiente</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            <?php else: ?>
                                <?= $pago['MetodoPago'] ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <select class="form-select form-select-sm payment-status" data-id="<?= $pago['IdPago'] ?>">
                                <option value="pendiente" <?= $pago['EstatusPago'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                <option value="pagado" <?= $pago['EstatusPago'] === 'pagado' ? 'selected' : '' ?>>Pagado</option>
                                <option value="cancelado" <?= $pago['EstatusPago'] === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>

        <hr class="my-5">

        <h3 class="text-primary-subtitle mb-3">Tarifas de Servicios</h3>
        <table id="fees" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Descripción del servicio</th>
                    <th>Costo base</th>
                    <th>Especialidad</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once '../../../app/models/Fees/getFees.php';

            $fees = getFees();
            foreach($fees as $fee): ?>
                <tr data-fee-id = "<?= $fee['IdTarifa'] ?>">
                <td data-field = 'DescripcionServicio' contenteditable = 'true'><?= $fee['DescripcionServicio'] ?></td>
                <td data-field = 'CostoBase' contenteditable = 'true'><?= $fee['CostoBase']?></td>
                <td data-field = 'Especialidad' contenteditable = 'true'><?= $fee['NombreEspecialidad']?></td>
                <td><? if($fee['Estatus'] == 1){ ?><span class="fa-solid fa-circle"></span><? }else {?><span class="fa-regular fa-circle"></span><?}?></td>
                <td>
                    <a href="feeDetails.php?id=<?= $fee['IdTarifa'] ?>" class="fa-solid fa-eye btn-secondary me-2 icon-btn"></a>
                    <button class="fa-solid fa-trash btn-secondary deleteBtn"></button>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <form action="../../../app/models/Fees/createFee.php" method="post">
            <button type="submit" id = "createFee" class = "btn-primary"><i class="fa-solid fa-plus"></i>Crear tarifa</button>
        </form>

    </div>

    </div>

    </div>
    </div>
    

    <script src="../../js/fees_and_payments.js"></script>
    <script src="../../../app/controllers/fees_and_paymentController.js"></script>
</body>
</html>