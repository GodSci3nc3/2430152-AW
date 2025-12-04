<?php
include '../../../config/connectDatabase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idUsuario = $_POST['IdUsuario'];
    $permisoPacientes = isset($_POST['PermisoPacientes']) ? 1 : 0;
    $permisoCitas = isset($_POST['PermisoCitas']) ? 1 : 0;
    $permisoExpedientes = isset($_POST['PermisoExpedientes']) ? 1 : 0;
    $permisoTarifas = isset($_POST['PermisoTarifas']) ? 1 : 0;

    $sql = "UPDATE Usuarios 
            SET PermisoPacientes = :permisoPacientes,
                PermisoCitas = :permisoCitas,
                PermisoExpedientes = :permisoExpedientes,
                PermisoTarifas = :permisoTarifas
            WHERE IdUsuario = :idUsuario";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':permisoPacientes', $permisoPacientes);
    $stmt->bindParam(':permisoCitas', $permisoCitas);
    $stmt->bindParam(':permisoExpedientes', $permisoExpedientes);
    $stmt->bindParam(':permisoTarifas', $permisoTarifas);
    $stmt->bindParam(':idUsuario', $idUsuario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al actualizar permisos'
        ]);
    }
}
?>
