<?php
session_start();
require_once __DIR__ . '/../../../config/connectDatabase.php';

if (!isset($_SESSION['idMedico'])) {
    echo json_encode([]);
    exit;
}

$doctorId = $_SESSION['idMedico'];

$sql = "SELECT c.IdCita, p.NombreCompleto as PatientName, c.FechaCita, c.MotivoConsulta 
        FROM Citas c 
        INNER JOIN Pacientes p ON c.IdPaciente = p.IdPaciente 
        WHERE c.IdMedico = :doctorId 
        AND c.EstadoCita != 'cancelada'
        ORDER BY c.FechaCita ASC";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':doctorId', $doctorId);
$stmt->execute();

$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($appointments);
?>