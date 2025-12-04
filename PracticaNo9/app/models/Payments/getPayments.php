<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

header('Content-Type: application/json');

try {
    $sql = "SELECT p.*, 
                   pac.NombreCompleto as NombrePaciente,
                   c.FechaCita,
                   c.MotivoConsulta,
                   m.NombreCompleto as NombreMedico,
                   e.NombreEspecialidad,
                   t.DescripcionServicio
            FROM Pagos p
            LEFT JOIN Pacientes pac ON p.IdPaciente = pac.IdPaciente
            LEFT JOIN Citas c ON p.IdCita = c.IdCita
            LEFT JOIN Medicos m ON c.IdMedico = m.IdMedico
            LEFT JOIN Especialidades e ON m.EspecialidadId = e.IdEspecialidad
            LEFT JOIN Tarifas t ON p.IdTarifa = t.IdTarifa
            ORDER BY p.FechaPago DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $pagos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $pagos
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener pagos: ' . $e->getMessage()
    ]);
}
