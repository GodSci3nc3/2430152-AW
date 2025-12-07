<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: appointments.php');
    exit();
}

require_once '../../../app/models/Appointments/getAppointments.php';

$appointments = getAppointments();
$appointment = null;

foreach($appointments as $apt) {
    if ($apt['IdCita'] == $_GET['id']) {
        $appointment = $apt;
        break;
    }
}

if (!$appointment) {
    header('Location: appointments.php');
    exit();
}

require_once '../../../app/models/Patients/getPatients.php';
require_once '../../../app/models/Doctors/getDoctors.php';

$patients = getPatients();
$doctors = getDoctors();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de cita - Medicore</title>

    <link rel="icon" href="../../../resources/Medicore Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/globalStyles.css">

    <script src="https://kit.fontawesome.com/aad8366bcb.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <div id="system-response" class="alert system-response-box"></div>

    <div class="container-fluid">
        <div class="row">

        <div class="col-md-3 d-md-block">
        <?php require '../../components/sidebar.php';?>
        </div>

        <div class="col-md-9 p-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-primary-title">Detalles de cita</h1>
                <a href="appointments.php" class="btn-secondary"><i class="fa-solid fa-arrow-left"></i> Volver</a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="text-primary-subtitle mb-4">Información de la cita</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Paciente</label>
                                    <select class="form-control" data-field="IdPaciente">
                                        <?php foreach($patients as $patient): ?>
                                            <option value="<?= $patient['IdPaciente'] ?>" 
                                                <?php if($appointment['IdPaciente'] == $patient['IdPaciente']) { echo 'selected'; } ?>>
                                                <?= $patient['NombreCompleto'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Médico</label>
                                    <select class="form-control" data-field="IdMedico">
                                        <?php foreach($doctors as $doctor): ?>
                                            <option value="<?= $doctor['IdMedico'] ?>" 
                                                <?php if($appointment['IdMedico'] == $doctor['IdMedico']) { echo 'selected'; } ?>>
                                                <?= $doctor['NombreCompleto'] ?> - <?= $doctor['NombreEspecialidad'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Fecha y hora</label>
                                    <input type="datetime-local" class="form-control" data-field="FechaCita" 
                                        value="<?= date('Y-m-d\TH:i', strtotime($appointment['FechaCita'])) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Estado</label>
                                    <select class="form-control" data-field="EstadoCita">
                                        <option value="Programada" <?php if($appointment['EstadoCita'] == 'Programada') { echo 'selected'; } ?>>Programada</option>
                                        <option value="Confirmada" <?php if($appointment['EstadoCita'] == 'Confirmada') { echo 'selected'; } ?>>Confirmada</option>
                                        <option value="En proceso" <?php if($appointment['EstadoCita'] == 'En proceso') { echo 'selected'; } ?>>En proceso</option>
                                        <option value="Completada" <?php if($appointment['EstadoCita'] == 'Completada') { echo 'selected'; } ?>>Completada</option>
                                        <option value="Cancelada" <?php if($appointment['EstadoCita'] == 'Cancelada') { echo 'selected'; } ?>>Cancelada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Motivo de consulta</label>
                                <textarea class="form-control" rows="3" data-field="MotivoConsulta"><?= $appointment['MotivoConsulta'] ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Servicio adicional (opcional)</label>
                                <select class="form-control" data-field="IdTarifa">
                                    <option value="">Ninguno - Solo consulta ($500)</option>
                                    <?php
                                    require_once '../../../app/models/Fees/getFees.php';
                                    $fees = getFees();
                                    foreach($fees as $fee): 
                                        if ($fee['Estatus'] == 1):
                                    ?>
                                        <option value="<?= $fee['IdTarifa'] ?>" <?php if($appointment['IdTarifa'] == $fee['IdTarifa']) { echo 'selected'; } ?>>
                                            <?= $fee['DescripcionServicio'] ?> (+$<?= number_format($fee['CostoBase'], 2) ?>)
                                        </option>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </select>
                                <small class="text-muted">Precio total: $500 (consulta) + servicio seleccionado</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Observaciones</label>
                                <textarea class="form-control" rows="3" data-field="Observaciones"><?= $appointment['Observaciones'] ?? '' ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-primary-subtitle mb-3">Acciones rápidas</h5>
                            
                            <?php if($appointment['EstadoCita'] != 'Completada' && $appointment['EstadoCita'] != 'completed'): ?>
                            <button id="markCompleted" class="btn-primary w-100 mb-2">
                                <i class="fa-solid fa-check"></i> Marcar como completada
                            </button>
                            <?php endif; ?>
                            
                            <?php if($appointment['EstadoCita'] != 'Cancelada' && $appointment['EstadoCita'] != 'cancelled'): ?>
                            <button id="markCancelled" class="btn-secondary w-100 mb-2">
                                <i class="fa-solid fa-times"></i> Cancelar cita
                            </button>
                            <?php endif; ?>

                            <a href="../doctor/record.php?id=<?= $appointment['IdPaciente'] ?>" class="btn-primary w-100 btn-link-primary">
                                <i class="fa-solid fa-folder-open"></i> Ver expediente
                            </a>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="text-primary-subtitle mb-3">Información</h5>
                            <p class="mb-2"><strong>ID de cita:</strong> <?= $appointment['IdCita'] ?></p>
                            <p class="mb-0"><strong>Registrada:</strong> <?= date('d/m/Y H:i', strtotime($appointment['FechaCita'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($appointment['EstadoCita'] == 'Completada'): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-primary-subtitle mb-4">Registrar consulta médica</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Diagnóstico</label>
                                <textarea class="form-control" id="diagnostico" rows="3" placeholder="Diagnóstico del paciente..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tratamiento prescrito</label>
                                <textarea class="form-control" id="tratamiento" rows="3" placeholder="Medicamentos, terapias, recomendaciones..."></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Presión arterial</label>
                                    <input type="text" class="form-control" id="presionArterial" placeholder="120/80">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Temperatura (°C)</label>
                                    <input type="text" class="form-control" id="temperatura" placeholder="36.5">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Peso (kg)</label>
                                    <input type="text" class="form-control" id="peso" placeholder="70">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Altura (cm)</label>
                                    <input type="text" class="form-control" id="altura" placeholder="170">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Notas adicionales</label>
                                <textarea class="form-control" id="notasConsulta" rows="2" placeholder="Observaciones adicionales..."></textarea>
                            </div>

                            <button id="saveConsultation" class="btn-primary">
                                <i class="fa-solid fa-save"></i> Guardar consulta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>

        </div>
    </div>

    <script>
        const appointmentId = <?= $appointment['IdCita'] ?>;

        function showSystemResponse(type, message) {
            const responseBox = $('#system-response');
            responseBox.removeClass('alert-success alert-danger alert-warning');
            
            if (type === 'success') {
                responseBox.addClass('alert-success');
            } else if (type === 'error') {
                responseBox.addClass('alert-danger');
            } else {
                responseBox.addClass('alert-warning');
            }
            
            responseBox.text(message).fadeIn();
            
            setTimeout(function() {
                responseBox.fadeOut();
            }, 3000);
        }

        $('select[data-field], input[data-field], textarea[data-field]').on('change blur', function() {
            const field = $(this).data('field');
            const value = $(this).val();

            $.ajax({
                url: '../../../app/models/Appointments/updateAppointment.php',
                method: 'POST',
                data: {
                    IdCita: appointmentId,
                    field: field,
                    value: value
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (!data.success && data.message) {
                        alert(data.message);
                    }
                },
                error: function() {
                    alert('Error al actualizar la cita');
                }
            });
        });

        $('#markCompleted').on('click', function() {
            $.ajax({
                url: '../../../app/models/Appointments/updateAppointment.php',
                method: 'POST',
                data: {
                    IdCita: appointmentId,
                    field: 'EstadoCita',
                    value: 'completed'
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Error al actualizar');
                    }
                }
            });
        });

        $('#markCancelled').on('click', function() {
            $.ajax({
                url: '../../../app/models/Appointments/updateAppointment.php',
                method: 'POST',
                data: {
                    IdCita: appointmentId,
                    field: 'EstadoCita',
                    value: 'cancelled'
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Error al actualizar');
                    }
                }
            });
        });

        $('#saveConsultation').on('click', function() {
            const diagnostico = $('#diagnostico').val();
            const tratamiento = $('#tratamiento').val();
            const presionArterial = $('#presionArterial').val();
            const temperatura = $('#temperatura').val();
            const peso = $('#peso').val();
            const altura = $('#altura').val();
            const notasConsulta = $('#notasConsulta').val();

            if (!diagnostico || !tratamiento) {
                alert('⚠️ El diagnóstico y tratamiento son obligatorios');
                return;
            }

            const signosVitales = 'PA: ' + (presionArterial || 'N/A') + 
                                 ', Temp: ' + (temperatura || 'N/A') + '°C' +
                                 ', Peso: ' + (peso || 'N/A') + 'kg' +
                                 ', Altura: ' + (altura || 'N/A') + 'cm';

            $.ajax({
                url: '../../../app/models/Records/createRecord.php',
                method: 'POST',
                data: {
                    patientId: <?= $appointment['IdPaciente'] ?>,
                    symptoms: signosVitales,
                    diagnosis: diagnostico,
                    treatment: tratamiento,
                    prescription: tratamiento,
                    notes: notasConsulta
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        alert('✅ Consulta registrada correctamente');
                        $('#diagnostico, #tratamiento, #presionArterial, #temperatura, #peso, #altura, #notasConsulta').val('');
                        setTimeout(() => location.reload(), 500);
                    } else {
                        alert('❌ ' + (data.message || 'Error al registrar la consulta'));
                    }
                },
                error: function() {
                    alert('❌ Error de conexión al registrar la consulta');
                }
            });
        });
    </script>

    <script src="../../js/sidebar.js"></script>

</body>
</html>
