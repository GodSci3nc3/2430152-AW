<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

header('Content-Type: application/json');

if (!isset($_POST['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'ID de reporte no proporcionado'
    ]);
    exit();
}

$idReporte = $_POST['id'];

try {
    // Eliminar de base de datos
    $sql = "DELETE FROM Reportes WHERE IdReporte = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idReporte);
    $stmt->execute();
    
    echo json_encode([
        'success' => true,
        'message' => 'Reporte eliminado correctamente'
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al eliminar reporte: ' . $e->getMessage()
    ]);
}
