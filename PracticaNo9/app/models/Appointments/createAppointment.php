<?php
include '../../../config/connectDatabase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = "INSERT INTO Citas 
            (IdPaciente, IdMedico, FechaCita, MotivoConsulta, EstadoCita, Observaciones)
            VALUES 
            (:patientId, :doctorId, :appointmentDate, :reason, :status, :notes)";

    $patientId = $_POST['patientId'];
    $doctorId = $_POST['doctorId'];
    $appointmentDate = $_POST['appointmentDate'];
    $reason = $_POST['reason'] ?? 'General consultation';
    $status = 'scheduled';
    $notes = $_POST['notes'] ?? '';

    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':patientId', $patientId);
    $stmt->bindParam(':doctorId', $doctorId);
    $stmt->bindParam(':appointmentDate', $appointmentDate);
    $stmt->bindParam(':reason', $reason);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':notes', $notes);

    $stmt->execute();
    
    echo json_encode(['success' => true]);
}
?>