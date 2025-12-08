<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SESSION['rol'] != 'doctor') {
    header('Location: /PracticaNo9/views/components/404.html');
    exit();
}

$isEdit = isset($_GET['id']);
$agenda = null;

if ($isEdit) {
    require_once '../../../app/models/Agenda/getAgenda.php';
    $agenda = getAgendaById($_GET['id']);
    
    if (!$agenda || $agenda['IdUsuario'] != $_SESSION['idMedico']) {
        header('Location: agenda.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if ($isEdit) { echo 'Ver'; } else { echo 'Nueva'; } ?> entrada - Agenda médica</title>

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

            <div class="col-md-9 p-4">
                
                <div id="systemResponseContainer"></div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="text-primary-title"><?php if ($isEdit) { echo 'Ver entrada de bitácora'; } else { echo 'Nueva entrada de bitácora'; } ?></h1>
                    <a href="agenda.php" class="btn-secondary"><i class="fa-solid fa-arrow-left"></i> Volver</a>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4">
                                    <label class="form-label">Módulo de trabajo</label>
                                    <input type="text" class="form-control" id="modulo" value="<?php if ($isEdit) { echo $agenda['Modulo']; } ?>" <?php if ($isEdit) { echo 'data-field="Modulo"'; } ?>>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Acciones realizadas</label>
                                    <textarea class="form-control" id="accionRealizada" rows="8" maxlength="250" <?php if ($isEdit) { echo 'data-field="AccionRealizada"'; } ?>><?php if ($isEdit) { echo $agenda['AccionRealizada']; } ?></textarea>
                                    <small class="text-muted">
                                        <span id="charCount">0</span>/250 caracteres
                                    </small>
                                </div>


                            </div>
                        </div>

                        <?php if ($isEdit): ?>
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="text-primary-subtitle mb-3">Información de registro</h5>
                                <p class="mb-2"><strong>Fecha de creación:</strong> <?= date('d/m/Y H:i', strtotime($agenda['FechaAcceso'])) ?></p>
                                <p class="mb-0"><strong>Usuario:</strong> <?= $_SESSION['username'] ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Contador de caracteres
        const textarea = document.getElementById('accionRealizada');
        const charCount = document.getElementById('charCount');
        
        function updateCharCount() {
            charCount.textContent = textarea.value.length;
        }
        
        textarea.addEventListener('input', updateCharCount);
        updateCharCount();

        // Función para mostrar mensajes del sistema
        function showSystemResponse(type, message) {
            const container = $('<div>').addClass('system-response').addClass(type).text(message);
            $('body').append(container);
            setTimeout(() => container.addClass('show'), 10);
            setTimeout(() => {
                container.removeClass('show');
                setTimeout(() => container.remove(), 300);
            }, 3000);
        }

        // Auto-guardar con blur (crear y editar)
        $('#modulo, #accionRealizada').on('blur', function() {
            const modulo = $('#modulo').val().trim();
            const accion = $('#accionRealizada').val().trim();

            if (!modulo || !accion) {
                return;
            }

            <?php if (!$isEdit): ?>
            // Crear nueva entrada
            $.ajax({
                url: '../../../app/models/Agenda/createAgenda.php',
                method: 'POST',
                data: {
                    modulo: modulo,
                    accion: accion
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        showSystemResponse('success', 'Entrada guardada correctamente');
                        // Redirigir a edición de la entrada recién creada
                        setTimeout(() => {
                            window.location.href = 'agendaDetails.php?id=' + data.id;
                        }, 1000);
                    } else {
                        showSystemResponse('error', data.message || 'Error al guardar');
                    }
                },
                error: function() {
                    showSystemResponse('error', 'Error de conexión');
                }
            });
            <?php else: ?>
            // Actualizar entrada existente
            const field = $(this).data('field');
            const value = $(this).val();

            $.ajax({
                url: '../../../app/models/Agenda/updateAgenda.php',
                method: 'POST',
                data: {
                    idBitacora: <?= $agenda['IdBitacora'] ?>,
                    field: field,
                    value: value
                },
                success: function(response) {
                    showSystemResponse('success', 'Cambios guardados');
                },
                error: function() {
                    showSystemResponse('error', 'Error al actualizar');
                }
            });
            });
            <?php endif; ?>
        });
    </script>

    <script src="../../js/sidebar.js"></script>
</body>
</html>
