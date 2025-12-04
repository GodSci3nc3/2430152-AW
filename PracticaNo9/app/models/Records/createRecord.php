<?php
include '../../../config/connectDatabase.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = "INSERT INTO Expedientes 
            (IdPaciente, IdMedico, FechaConsulta, Sintomas, Diagnostico, Tratamiento, 
             RecetaMedica, NotasAdicionales, ProximaCita)
            VALUES 
            (:patientId, :doctorId, :consultDate, :symptoms, :diagnosis, :treatment,
             :prescription, :notes, :nextAppointment)";

    $patientId = $_POST['patientId'];
    $doctorId = $_SESSION['idMedico'];
    $consultDate = date('Y-m-d H:i:s');
    $symptoms = $_POST['symptoms'] ?? '';
    $diagnosis = $_POST['diagnosis'] ?? '';
    $treatment = $_POST['treatment'] ?? '';
    $prescription = $_POST['prescription'] ?? '';
    $notes = $_POST['notes'] ?? '';
    $nextAppointment = $_POST['nextAppointment'] ?? null;

    if (empty($nextAppointment)) {
        $nextAppointment = null;
    }

    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':patientId', $patientId);
    $stmt->bindParam(':doctorId', $doctorId);
    $stmt->bindParam(':consultDate', $consultDate);
    $stmt->bindParam(':symptoms', $symptoms);
    $stmt->bindParam(':diagnosis', $diagnosis);
    $stmt->bindParam(':treatment', $treatment);
    $stmt->bindParam(':prescription', $prescription);
    $stmt->bindParam(':notes', $notes);
    $stmt->bindParam(':nextAppointment', $nextAppointment);

    $stmt->execute();
    
    echo json_encode(['success' => true]);
}
?>