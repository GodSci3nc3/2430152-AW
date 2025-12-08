<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_POST['idUsuario'];
    $nuevaPassword = $_POST['password'];
    $idMedico = $_SESSION['idMedico'];
    
    // Verificar que la recepcionista pertenece a este médico
    $sql = "SELECT IdUsuario FROM Usuarios WHERE IdUsuario = :idUsuario AND IdMedicoAsignado = :idMedico";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->bindParam(':idMedico', $idMedico);
    $stmt->execute();
    
    if ($stmt->fetch()) {
        // Actualizar contraseña
        $passwordHash = password_hash($nuevaPassword, PASSWORD_DEFAULT);
        $sqlUpdate = "UPDATE Usuarios SET ContrasenaHash = :password WHERE IdUsuario = :idUsuario";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':password', $passwordHash);
        $stmtUpdate->bindParam(':idUsuario', $idUsuario);
        
        if ($stmtUpdate->execute()) {
            echo json_encode(['success' => true, 'message' => 'Contraseña actualizada correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar contraseña']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No tienes permiso para modificar esta recepcionista']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
