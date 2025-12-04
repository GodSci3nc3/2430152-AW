<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

header('Content-Type: application/json');

try {
    $sql = "SELECT r.*, p.NombreCompleto as NombrePaciente 
            FROM Reportes r
            LEFT JOIN Pacientes p ON r.IdPaciente = p.IdPaciente
            ORDER BY r.FechaGeneracion DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $reportes
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener reportes: ' . $e->getMessage()
    ]);
}
