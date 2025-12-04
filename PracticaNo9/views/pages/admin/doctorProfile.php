<?php

session_start();

if(!isset($_SESSION['username'])){
    Header('Location: ../login.php');
} else {
    if($_SESSION['rol'] != 'admin'){
        Header('Location: /PracticaNo9/views/components/404.html');
    }
}

$doctorId = $_GET['id'] ?? null;
if (!$doctorId) {
    Header('Location: doctors.php');
}

require_once '../../../app/models/Doctors/getDoctors.php';
require_once '../../../app/models/Specialties/getSpecialties.php';

$doctors = getDoctors();
$doctor = null;
foreach($doctors as $d) {
    if($d['IdMedico'] == $doctorId) {
        $doctor = $d;
        break;
    }
}

if (!$doctor) {
    Header('Location: doctors.php');
}

$specialties = getSpecialties();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de doctor - Medicore</title>

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

        <h1 class="text-primary-title mb-4">Perfil de doctor - <?= $doctor['NombreCompleto'] ?></h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="text-primary-subtitle">Información personal</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" data-field="NombreCompleto" value="<?= $doctor['NombreCompleto'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" data-field="Telefono" value="<?= $doctor['Telefono'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" data-field="CorreoElectronico" value="<?= $doctor['CorreoElectronico'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cédula profesional</label>
                            <input type="text" class="form-control" data-field="CedulaProfesional" value="<?= $doctor['CedulaProfesional'] ?>">
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="text-primary-subtitle">Información profesional</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Especialidad</label>
                            <select class="form-control" data-field="IdEspecialidad">
                                <?php foreach($specialties as $specialty): ?>
                                    <option value="<?= $specialty['IdEspecialidad'] ?>" 
                                        <?php if($doctor['NombreEspecialidad'] == $specialty['NombreEspecialidad']) { echo 'selected'; } ?>>
                                        <?= $specialty['NombreEspecialidad'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Horario de atención</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label small">Hora inicio</label>
                                    <input type="time" class="form-control" id="horaInicio" value="09:00">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small">Hora fin</label>
                                    <input type="time" class="form-control" id="horaFin" value="17:00">
                                </div>
                            </div>
                            <small class="text-muted">Se guardará automáticamente al cambiar</small>
                            <input type="hidden" data-field="HorarioAtencion" id="horarioFull" value="<?= $doctor['HorarioAtencion'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-control" data-field="Estatus">
                                <option value="1" <?php if($doctor['Estatus'] == 1) { echo 'selected'; } ?>>Activo</option>
                                <option value="0" <?php if($doctor['Estatus'] == 0) { echo 'selected'; } ?>>Inactivo</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <a href="doctors.php" class="btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>Volver a doctores
        </a>

    </div>

    </div>

    </div>
    </div>

    <script>
    const doctorId = <?= $doctorId ?>;
    const message = document.getElementById('systemResponse');

    const horarioActual = '<?= $doctor['HorarioAtencion'] ?>';
    if (horarioActual) {
        const partes = horarioActual.split('-');
        if (partes.length == 2) {
            document.getElementById('horaInicio').value = partes[0].trim();
            document.getElementById('horaFin').value = partes[1].trim();
        }
    }

    document.getElementById('horaInicio').addEventListener('change', updateHorario);
    document.getElementById('horaFin').addEventListener('change', updateHorario);

    function updateHorario() {
        const inicio = document.getElementById('horaInicio').value;
        const fin = document.getElementById('horaFin').value;
        const horarioCompleto = inicio + ' - ' + fin;
        
        document.getElementById('horarioFull').value = horarioCompleto;
        
        $.ajax({
            url: '../../../app/models/Doctors/updateDoctor.php',
            type: 'POST',
            data: {
                idDoctor: doctorId,
                column: 'HorarioAtencion',
                change: horarioCompleto
            },
            success: function() {
                message.textContent = 'Horario actualizado';
                message.classList.add('active');
                setTimeout(() => {
                    message.classList.remove('active');
                }, 2000);
            }
        });
    }

    document.querySelectorAll('input[data-field], select[data-field]').forEach(field => {
        field.addEventListener('change', function() {
            const column = this.dataset.field;
            const value = this.value;

            $.ajax({
                url: '../../../app/models/Doctors/updateDoctor.php',
                type: 'POST',
                data: {
                    idDoctor: doctorId,
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
