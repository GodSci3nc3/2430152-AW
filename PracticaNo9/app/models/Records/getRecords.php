<?php
    require_once __DIR__ . '/../../../config/connectDatabase.php';

    function getRecordsByPatient($patientId) {
        global $pdo;

        $sql = "SELECT e.*, p.NombreCompleto as PatientName, m.NombreCompleto as DoctorName 
                FROM Expedientes e 
                INNER JOIN Pacientes p ON e.IdPaciente = p.IdPaciente 
                INNER JOIN Medicos m ON e.IdMedico = m.IdMedico 
                WHERE e.IdPaciente = :patientId 
                ORDER BY e.FechaConsulta DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':patientId', $patientId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPatientDetail($patientId) {
        global $pdo;

        $sql = "SELECT * FROM Pacientes WHERE IdPaciente = :patientId";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':patientId', $patientId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>