<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

function getIngresosPorEspecialidad() {
    global $pdo;
    
    $sql = "SELECT 
                e.NombreEspecialidad,
                COALESCE(SUM(p.Monto), 0) as totalIngresos
            FROM Especialidades e
            LEFT JOIN Medicos m ON e.IdEspecialidad = m.EspecialidadId
            LEFT JOIN Citas c ON m.IdMedico = c.IdMedico
            LEFT JOIN Pagos p ON c.IdCita = p.IdCita AND p.EstatusPago = 'Pagado'
            GROUP BY e.IdEspecialidad, e.NombreEspecialidad
            ORDER BY totalIngresos DESC
            LIMIT 5";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
