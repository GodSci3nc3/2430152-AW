<?php

session_start();

if(!isset($_SESSION['username'])){
    Header('Location: ../login.php');
} else {
    if($_SESSION['rol'] != 'admin'){
        Header('Location: /PracticaNo9/views/components/404.html');
    }
}

$userId = $_GET['id'] ?? null;
if (!$userId) {
    Header('Location: users.php');
}

require_once '../../../app/models/User/getUsers.php';
$users = getUsers();
$user = null;
foreach($users as $u) {
    if($u['IdUsuario'] == $userId) {
        $user = $u;
        break;
    }
}

if (!$user) {
    Header('Location: users.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de usuario - Medicore</title>

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

        <h1 class="text-primary-title mb-4">Perfil de usuario</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="text-primary-subtitle">Información básica</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" id="username" data-field="Usuario" value="<?= $user['Usuario'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" data-field="CorreoElectronico" value="<?= $user['CorreoElectronico'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rol</label>
                            <select class="form-control" id="role" data-field="Rol">
                                <option value="admin" <?php if($user['Rol'] == 'admin') { echo 'selected'; } ?>>Administrador</option>
                                <option value="doctor" <?php if($user['Rol'] == 'doctor') { echo 'selected'; } ?>>Doctor</option>
                                <option value="receptionist" <?php if($user['Rol'] == 'receptionist') { echo 'selected'; } ?>>Recepcionista</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-control" id="status" data-field="Activo">
                                <option value="1" <?php if($user['Activo'] == 1) { echo 'selected'; } ?>>Activo</option>
                                <option value="0" <?php if($user['Activo'] == 0) { echo 'selected'; } ?>>Inactivo</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="text-primary-subtitle mb-4">Permisos de acceso</h5>
                        <p class="text-muted mb-3 permission-description">Selecciona los módulos a los que este usuario puede acceder</p>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="permisoPacientes" 
                                <?php if(isset($user['PermisoPacientes']) && $user['PermisoPacientes']) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="permisoPacientes">
                                <i class="fa-solid fa-users me-2"></i>Gestión de pacientes
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="permisoCitas" 
                                <?php if(isset($user['PermisoCitas']) && $user['PermisoCitas']) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="permisoCitas">
                                <i class="fa-solid fa-calendar-check me-2"></i>Gestión de citas
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="permisoExpedientes" 
                                <?php if(isset($user['PermisoExpedientes']) && $user['PermisoExpedientes']) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="permisoExpedientes">
                                <i class="fa-solid fa-folder-open me-2"></i>Acceso a expedientes
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="permisoTarifas" 
                                <?php if(isset($user['PermisoTarifas']) && $user['PermisoTarifas']) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="permisoTarifas">
                                <i class="fa-solid fa-dollar-sign me-2"></i>Gestión de tarifas y pagos
                            </label>
                        </div>

                        <button id="updatePermissions" class="btn-primary mt-2">
                            <i class="fa-solid fa-shield-halved"></i> Actualizar permisos
                        </button>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="text-primary-subtitle">Cambiar contraseña</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control" id="newPassword">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="confirmPassword">
                        </div>

                        <button id="changePassword" class="btn-primary">
                            <i class="fa-solid fa-key"></i>Cambiar contraseña
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <a href="users.php" class="btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>Volver a usuarios
        </a>

    </div>

    </div>

    </div>
    </div>

    <script>
    const userId = <?= $userId ?>;
    const message = document.getElementById('systemResponse');

    document.querySelectorAll('input[data-field], select[data-field]').forEach(field => {
        field.addEventListener('change', function() {
            const column = this.dataset.field;
            const value = this.value;

            $.ajax({
                url: '../../../app/models/User/updateUser.php',
                type: 'POST',
                data: {
                    idUser: userId,
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

    document.getElementById('updatePermissions').addEventListener('click', function() {
        const permisoPacientes = document.getElementById('permisoPacientes').checked;
        const permisoCitas = document.getElementById('permisoCitas').checked;
        const permisoExpedientes = document.getElementById('permisoExpedientes').checked;
        const permisoTarifas = document.getElementById('permisoTarifas').checked;

        const formData = new FormData();
        formData.append('IdUsuario', userId);
        if (permisoPacientes) formData.append('PermisoPacientes', '1');
        if (permisoCitas) formData.append('PermisoCitas', '1');
        if (permisoExpedientes) formData.append('PermisoExpedientes', '1');
        if (permisoTarifas) formData.append('PermisoTarifas', '1');

        $.ajax({
            url: '../../../app/models/User/updatePermissions.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                const data = JSON.parse(response);
                if (data.success) {
                    message.textContent = 'Permisos actualizados correctamente';
                    message.classList.add('active');
                    setTimeout(() => {
                        message.classList.remove('active');
                    }, 2000);
                } else {
                    message.textContent = 'Error al actualizar permisos';
                    message.classList.add('active');
                }
            },
            error: function() {
                message.textContent = 'Error al actualizar permisos';
                message.classList.add('active');
            }
        });
    });

    document.getElementById('changePassword').addEventListener('click', function() {
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (!newPassword || newPassword.length < 6) {
            message.textContent = 'La contraseña debe tener al menos 6 caracteres';
            message.classList.add('active');
            return;
        }

        if (newPassword != confirmPassword) {
            message.textContent = 'Las contraseñas no coinciden';
            message.classList.add('active');
            return;
        }

        $.ajax({
            url: '../../../app/models/User/updateUser.php',
            type: 'POST',
            data: {
                idUser: userId,
                column: 'Contrasena',
                change: newPassword
            },
            success: function() {
                message.textContent = 'Contraseña actualizada';
                message.classList.add('active');
                document.getElementById('newPassword').value = '';
                document.getElementById('confirmPassword').value = '';
            },
            error: function() {
                message.textContent = 'Error al cambiar contraseña';
                message.classList.add('active');
            }
        });
    });
    </script>
</body>
</html>
