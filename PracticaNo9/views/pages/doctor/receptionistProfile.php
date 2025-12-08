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

require_once '../../../app/models/Receptionist/getReceptionist.php';

$receptionist = getReceptionistByDoctor($_SESSION['idMedico']);

if (!$receptionist) {
    header('Location: dashboard_doctor.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi recepcionista - Medicore</title>

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
                <?php require '../../components/sidebar.php'; ?>
            </div>

            <div class="col-md-9 p-4">
                
                <div id="systemResponseContainer"></div>

                <h1 class="text-primary-title mb-4">Mi recepcionista</h1>

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-primary-subtitle mb-4">Información de la cuenta</h5>

                                <div class="mb-3">
                                    <label class="form-label">Usuario</label>
                                    <input type="text" class="form-control" value="<?php echo $receptionist['Usuario']; ?>" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Estado</label>
                                    <input type="text" class="form-control" value="<?php echo $receptionist['Activo'] ? 'Activo' : 'Inactivo'; ?>" readonly>
                                </div>

                                <hr class="my-4">

                                <h5 class="text-primary-subtitle mb-4">Cambiar contraseña</h5>

                                <div class="mb-3">
                                    <label class="form-label">Nueva contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="newPassword" placeholder="Ingresa la nueva contraseña">
                                        <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                            <i class="fa-solid fa-eye" id="iconNewPassword"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Confirmar contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirma la nueva contraseña">
                                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                            <i class="fa-solid fa-eye" id="iconConfirmPassword"></i>
                                        </button>
                                    </div>
                                </div>

                                <button id="updatePasswordBtn" class="btn-primary">
                                    <i class="fa-solid fa-key"></i> Actualizar contraseña
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        $('#toggleNewPassword').on('click', function() {
            const input = $('#newPassword');
            const icon = $('#iconNewPassword');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#toggleConfirmPassword').on('click', function() {
            const input = $('#confirmPassword');
            const icon = $('#iconConfirmPassword');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        function showSystemResponse(type, message) {
            const container = $('<div>').addClass('system-response').addClass(type).text(message);
            $('#systemResponseContainer').append(container);
            setTimeout(() => container.addClass('show'), 10);
            setTimeout(() => {
                container.removeClass('show');
                setTimeout(() => container.remove(), 300);
            }, 3000);
        }

        $('#updatePasswordBtn').on('click', function() {
            const newPassword = $('#newPassword').val();
            const confirmPassword = $('#confirmPassword').val();

            if (!newPassword || !confirmPassword) {
                showSystemResponse('error', 'Complete todos los campos');
                return;
            }

            if (newPassword !== confirmPassword) {
                showSystemResponse('error', 'Las contraseñas no coinciden');
                return;
            }

            if (newPassword.length < 6) {
                showSystemResponse('error', 'La contraseña debe tener al menos 6 caracteres');
                return;
            }

            $.ajax({
                url: '../../../app/models/Receptionist/updatePassword.php',
                method: 'POST',
                data: {
                    idUsuario: <?php echo $receptionist['IdUsuario']; ?>,
                    password: newPassword
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        showSystemResponse('success', data.message);
                        $('#newPassword').val('');
                        $('#confirmPassword').val('');
                    } else {
                        showSystemResponse('error', data.message);
                    }
                },
                error: function() {
                    showSystemResponse('error', 'Error de conexión');
                }
            });
        });
    </script>

    <script src="../../js/sidebar.js"></script>
</body>
</html>
