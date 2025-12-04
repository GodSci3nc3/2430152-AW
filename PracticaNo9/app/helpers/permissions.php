<?php

function checkPermission($requiredPermission) {
    if (!isset($_SESSION['username'])) {
        header('Location: ../login.php');
        exit();
    }

    if ($_SESSION['rol'] == 'admin') {
        return true;
    }

    $permissionMap = [
        'pacientes' => 'permisoPacientes',
        'citas' => 'permisoCitas',
        'expedientes' => 'permisoExpedientes',
        'tarifas' => 'permisoTarifas'
    ];

    $sessionKey = $permissionMap[$requiredPermission] ?? null;
    
    if (!$sessionKey) {
        return false;
    }

    if (!isset($_SESSION[$sessionKey]) || !$_SESSION[$sessionKey]) {
        header('Location: /PracticaNo9/views/components/403.html');
        exit();
    }

    return true;
}

function hasPermission($requiredPermission) {
    if (!isset($_SESSION['username'])) {
        return false;
    }

    if ($_SESSION['rol'] == 'admin') {
        return true;
    }

    $permissionMap = [
        'pacientes' => 'permisoPacientes',
        'citas' => 'permisoCitas',
        'expedientes' => 'permisoExpedientes',
        'tarifas' => 'permisoTarifas'
    ];

    $sessionKey = $permissionMap[$requiredPermission] ?? null;
    
    if (!$sessionKey) {
        return false;
    }

    return isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey];
}

?>
