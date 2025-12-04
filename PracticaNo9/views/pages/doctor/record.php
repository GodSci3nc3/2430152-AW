<?php

session_start();
require_once '../../../app/helpers/permissions.php';

if(!isset($_SESSION['username'])){
    Header('Location: ../login.php');
} else {
    if($_SESSION['rol'] != 'doctor' && $_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'doctor'){
        Header('Location: /PracticaNo9/views/components/404.html');
    }
}

checkPermission('expedientes');

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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary-title mb-0">Expediente médico - <?= $patient['NombreCompleto'] ?></h1>
            <div>
                <a href="../../../app/models/Reports/generatePDF.php?id=<?= $idPaciente ?>" class="btn-primary me-2">
                    <i class="fa-solid fa-file-pdf"></i> Generar PDF
                </a>
                <a href="../../../app/models/Reports/generateExcel.php?id=<?= $idPaciente ?>" class="btn-secondary">
                    <i class="fa-solid fa-file-excel"></i> Generar Excel
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-primary-subtitle">Información personal</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" class="form-control patient-field" data-field="NombreCompleto" value="<?= $patient['NombreCompleto'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">CURP</label>
                            <input type="text" class="form-control patient-field" data-field="CURP" value="<?= $patient['CURP'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control patient-field" data-field="FechaNacimiento" value="<?= $patient['FechaNacimiento'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sexo</label>
                            <select class="form-control patient-field" data-field="Sexo">
                                <option value="M" <?php if($patient['Sexo'] == 'M') { echo 'selected'; } ?>>Masculino</option>
                                <option value="F" <?php if($patient['Sexo'] == 'F') { echo 'selected'; } ?>>Femenino</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control patient-field" data-field="Telefono" value="<?= $patient['Telefono'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control patient-field" data-field="CorreoElectronico" value="<?= $patient['CorreoElectronico'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <textarea class="form-control patient-field" data-field="Direccion" rows="2"><?= $patient['Direccion'] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-primary-subtitle">Información de emergencia</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Contacto de emergencia</label>
                            <input type="text" class="form-control patient-field" data-field="ContactoEmergencia" value="<?= $patient['ContactoEmergencia'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono de emergencia</label>
                            <input type="text" class="form-control patient-field" data-field="TelefonoEmergencia" value="<?= $patient['TelefonoEmergencia'] ?>">
                        </div>

                        <h5 class="text-primary-subtitle mt-4">Información médica</h5>

                        <div class="mb-3">
                            <label class="form-label">Alergias</label>
                            <textarea class="form-control patient-field" data-field="Alergias" rows="2"><?= $patient['Alergias'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Antecedentes médicos</label>
                            <textarea class="form-control patient-field" data-field="AntecedentesMedicos" rows="3"><?= $patient['AntecedentesMedicos'] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h3 class="text-primary-subtitle mb-3">Citas programadas</h3>
                <?php
                require_once '../../../app/models/Appointments/getAppointments.php';
                $appointments = getAppointments();
                $patientAppointments = array_filter($appointments, function($apt) use ($idPaciente) {
                    return $apt['IdPaciente'] == $idPaciente;
                });
                ?>
                <?php if (empty($patientAppointments)): ?>
                    <p class="text-primary-p">No hay citas programadas para este paciente.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Médico</th>
                                    <th>Estado</th>
                                    <th>Motivo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($patientAppointments as $apt): ?>
                                    <tr>
                                        <td><?= $apt['FechaCita'] ?></td>
                                        <td><?= $apt['DoctorName'] ?></td>
                                        <td><?= $apt['EstadoCita'] ?></td>
                                        <td><?= $apt['MotivoConsulta'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
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
    <script>
    const patientId = <?= $idPaciente ?>;
    const message = document.getElementById('systemResponse');

    document.querySelectorAll('.patient-field').forEach(field => {
        field.addEventListener('change', function() {
            const column = this.dataset.field;
            const value = this.value;

            $.ajax({
                url: '../../../app/models/Patients/updatePatient.php',
                type: 'POST',
                data: {
                    idPatient: patientId,
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