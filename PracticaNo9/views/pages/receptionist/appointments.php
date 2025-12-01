<?php

session_start();

if(!isset($_SESSION['username'])){
    Header('Location: ../login.php');
} else {
    if($_SESSION['rol'] != 'receptionist'){
        Header('Location: /PracticaNo9/views/components/404.html');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas médicas en Medicore</title>

    <link rel="icon" href="../../../resources/Medicore Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/globalStyles.css">

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
        <h1 class="text-primary-title mb-4">Citas médicas en Medicore</h1>

        <div class="systemResponse text-center mb-3">
            <p class="systemResponse disabled" id="systemResponse">Respuesta del sistema</p>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <select class="form-control" id="selectPatient">
                    <option value="">Seleccionar paciente</option>
                    <?php
                    require_once '../../../app/models/Patients/getPatients.php';
                    $patients = getPatients();
                    foreach($patients as $patient): ?>
                        <option value="<?= $patient['IdPaciente'] ?>"><?= $patient['NombreCompleto'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" id="selectDoctor">
                    <option value="">Seleccionar médico</option>
                    <?php
                    require_once '../../../app/models/Doctors/getDoctors.php';
                    $doctors = getDoctors();
                    foreach($doctors as $doctor): ?>
                        <option value="<?= $doctor['IdMedico'] ?>"><?= $doctor['NombreCompleto'] ?> - <?= $doctor['NombreEspecialidad'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="datetime-local" class="form-control" id="appointmentDate">
            </div>
            <div class="col-md-3">
                <button id="createAppointment" class="btn-primary w-100"><i class="fa-solid fa-plus"></i>Agendar</button>
            </div>
        </div>

        <table id="appointments" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Fecha y hora</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
            require_once '../../../app/models/Appointments/getAppointments.php';

            $appointments = getAppointments();

            foreach($appointments as $appointment): ?>
                <tr data-appointment-id="<?= $appointment['IdCita'] ?>">
                <td><?= $appointment['PatientName'] ?></td>
                <td><?= $appointment['DoctorName'] ?></td>
                <td data-field='FechaCita' contenteditable='true'><?= $appointment['FechaCita'] ?></td>
                <td data-field='MotivoConsulta' contenteditable='true'><?= $appointment['MotivoConsulta'] ?></td>
                <td data-field='EstadoCita' contenteditable='true'><?= $appointment['EstadoCita'] ?></td>
                <td>
                    <button class="fa-solid fa-trash btn-secondary deleteBtn"></button>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    </div>

    </div>
    </div>

    <script src="../../js/appointments.js"></script>
    <script src="../../../app/controllers/appointmentController.js"></script>
</body>
</html>