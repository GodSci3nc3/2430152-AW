<?php
include '../../../config/connectDatabase.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $sql = "INSERT INTO Bitacora (IdUsuario, Modulo, AccionRealizada, FechaAcceso)
            VALUES (:idUsuario, :modulo, :accion, NOW())";
    
    $idUsuario = $_SESSION['idUser'] ?? $_SESSION['idMedico'];
    $modulo = $_POST['modulo'];
    $accion = $_POST['accion'];
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->bindParam(':modulo', $modulo);
    $stmt->bindParam(':accion', $accion);
    
    if ($stmt->execute()) {
        $lastId = $pdo->lastInsertId();
        echo json_encode(['success' => true, 'id' => $lastId]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear entrada']);
    }
}
?>
