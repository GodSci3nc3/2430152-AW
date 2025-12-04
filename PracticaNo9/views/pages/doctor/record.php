<?php

session_start();

if(!isset($_SESSION['username'])){
    Header('Location: ../login.php');
} else {
    if($_SESSION['rol'] != 'doctor' && $_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'doctor'){
        Header('Location: /PracticaNo9/views/components/404.html');
    }
}

$idPaciente = $_GET['id'] ?? null;
if (!$idPaciente) {
    Header('Location: patients.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente médico</title>

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

        <?php
        require_once '../../../app/models/Records/getRecords.php';
        $patient = getPatientDetail($idPaciente);
        $records = getRecordsByPatient($idPaciente);
        ?>

        <h1 class="text-primary-title mb-4">Expediente médico - <?= $patient['NombreCompleto'] ?></h1>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Información del paciente</h5>
                        <p><strong>CURP:</strong> <?= $patient['CURP'] ?></p>
                        <p><strong>Fecha de nacimiento:</strong> <?= $patient['FechaNacimiento'] ?></p>
                        <p><strong>Sexo:</strong> <?= $patient['Sexo'] ?></p>
                        <p><strong>Teléfono:</strong> <?= $patient['Telefono'] ?></p>
                        <p><strong>Correo:</strong> <?= $patient['CorreoElectronico'] ?></p>
                        <p><strong>Dirección:</strong> <?= $patient['Direccion'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Información médica</h5>
                        <p><strong>Contacto de emergencia:</strong> <?= $patient['ContactoEmergencia'] ?></p>
                        <p><strong>Teléfono emergencia:</strong> <?= $patient['TelefonoEmergencia'] ?></p>
                        <p><strong>Alergias:</strong> <?= $patient['Alergias'] ?></p>
                        <p><strong>Antecedentes médicos:</strong> <?= $patient['AntecedentesMedicos'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <h3 class="text-primary-subtitle">Nueva consulta</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="symptoms">Síntomas</label>
                        <textarea class="form-control" id="symptoms" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="diagnosis">Diagnóstico</label>
                        <textarea class="form-control" id="diagnosis" rows="3"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="treatment">Tratamiento</label>
                        <textarea class="form-control" id="treatment" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="prescription">Receta médica</label>
                        <textarea class="form-control" id="prescription" rows="3"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="notes">Notas adicionales</label>
                        <textarea class="form-control" id="notes" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nextAppointment">Próxima cita</label>
                        <input type="datetime-local" class="form-control" id="nextAppointment">
                    </div>
                </div>
                <button id="saveConsultation" class="btn-primary" data-patient-id="<?= $idPaciente ?>">
                    <i class="fa-solid fa-save"></i>Guardar consulta
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h3 class="text-primary-subtitle mb-3">Historial de consultas</h3>
                <?php if (empty($records)): ?>
                    <p class="text-primary-p">No hay consultas registradas para este paciente.</p>
                <?php else: ?>
                    <?php foreach($records as $record): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="card-title">Consulta - <?= $record['FechaConsulta'] ?></h5>
                                        <p><strong>Médico:</strong> <?= $record['DoctorName'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Síntomas:</strong></p>
                                        <p data-field="Sintomas" data-record-id="<?= $record['IdExpediente'] ?>" contenteditable="true"><?= $record['Sintomas'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Diagnóstico:</strong></p>
                                        <p data-field="Diagnostico" data-record-id="<?= $record['IdExpediente'] ?>" contenteditable="true"><?= $record['Diagnostico'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Tratamiento:</strong></p>
                                        <p data-field="Tratamiento" data-record-id="<?= $record['IdExpediente'] ?>" contenteditable="true"><?= $record['Tratamiento'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Receta médica:</strong></p>
                                        <p data-field="RecetaMedica" data-record-id="<?= $record['IdExpediente'] ?>" contenteditable="true"><?= $record['RecetaMedica'] ?></p>
                                    </div>
                                </div>
                                <?php if ($record['NotasAdicionales']): ?>
                                <div class="row">
                                    <div class="col">
                                        <p><strong>Notas adicionales:</strong></p>
                                        <p data-field="NotasAdicionales" data-record-id="<?= $record['IdExpediente'] ?>" contenteditable="true"><?= $record['NotasAdicionales'] ?></p>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>

    </div>

    </div>
    </div>

    <script src="../../../app/controllers/recordController.js"></script>
</body>
</html>