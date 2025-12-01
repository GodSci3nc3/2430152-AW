<?php

session_start();

if(!isset($_SESSION['username'])){
    Header('Location: ../login.php');
} else {
    if($_SESSION['rol'] != 'doctor'){
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
        
        <?php
        require_once '../../../app/models/Records/getRecords.php';
        $patient = getPatientDetail($idPaciente);
        $records = getRecordsByPatient($idPaciente);
        ?>

        <h1 class="text-primary-title mb-4">Medical Record - <?= $patient['NombreCompleto'] ?></h1>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Patient information</h5>
                        <p><strong>CURP:</strong> <?= $patient['CURP'] ?></p>
                        <p><strong>Birth date:</strong> <?= $patient['FechaNacimiento'] ?></p>
                        <p><strong>Gender:</strong> <?= $patient['Sexo'] ?></p>
                        <p><strong>Phone:</strong> <?= $patient['Telefono'] ?></p>
                        <p><strong>Email:</strong> <?= $patient['CorreoElectronico'] ?></p>
                        <p><strong>Address:</strong> <?= $patient['Direccion'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Medical information</h5>
                        <p><strong>Emergency contact:</strong> <?= $patient['ContactoEmergencia'] ?></p>
                        <p><strong>Emergency phone:</strong> <?= $patient['TelefonoEmergencia'] ?></p>
                        <p><strong>Allergies:</strong> <?= $patient['Alergias'] ?></p>
                        <p><strong>Medical history:</strong> <?= $patient['AntecedentesMedicos'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <h3>New consultation</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="symptoms">Symptoms</label>
                        <textarea class="form-control" id="symptoms" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="diagnosis">Diagnosis</label>
                        <textarea class="form-control" id="diagnosis" rows="3"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="treatment">Treatment</label>
                        <textarea class="form-control" id="treatment" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="prescription">Prescription</label>
                        <textarea class="form-control" id="prescription" rows="3"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="notes">Additional notes</label>
                        <textarea class="form-control" id="notes" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nextAppointment">Next appointment</label>
                        <input type="datetime-local" class="form-control" id="nextAppointment">
                    </div>
                </div>
                <button id="saveConsultation" class="btn-primary" data-patient-id="<?= $idPaciente ?>">
                    <i class="fa-solid fa-save"></i>Save consultation
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h3>Consultation history</h3>
                <?php if (empty($records)): ?>
                    <p class="text-body">No consultations recorded for this patient.</p>
                <?php else: ?>
                    <?php foreach($records as $record): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="card-title">Consultation - <?= $record['FechaConsulta'] ?></h5>
                                        <p><strong>Doctor:</strong> <?= $record['DoctorName'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Symptoms:</strong></p>
                                        <p data-field="Sintomas" data-record-id="<?= $record['IdExpediente'] ?>" contenteditable="true"><?= $record['Sintomas'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Diagnosis:</strong></p>
                                        <p data-field="Diagnostico" data-record-id="<?= $record['IdExpediente'] ?>" contenteditable="true"><?= $record['Diagnostico'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Treatment:</strong></p>
                                        <p data-field="Tratamiento" data-record-id="<?= $record['IdExpediente'] ?>" contenteditable="true"><?= $record['Tratamiento'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Prescription:</strong></p>
                                        <p data-field="RecetaMedica" data-record-id="<?= $record['IdExpediente'] ?>" contenteditable="true"><?= $record['RecetaMedica'] ?></p>
                                    </div>
                                </div>
                                <?php if ($record['NotasAdicionales']): ?>
                                <div class="row">
                                    <div class="col">
                                        <p><strong>Additional notes:</strong></p>
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