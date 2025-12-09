<?php
    require_once __DIR__ . '/../../../config/connectDatabase.php';

    function getAppointments($doctorId = null) {
        global $pdo;

        $sql = "SELECT c.IdCita, c.IdPaciente, c.IdMedico, p.NombreCompleto as PatientName, m.NombreCompleto as DoctorName, 
                       c.FechaCita, c.MotivoConsulta, c.EstadoCita 
                FROM Citas c 
                INNER JOIN Pacientes p ON c.IdPaciente = p.IdPaciente 
                INNER JOIN Medicos m ON c.IdMedico = m.IdMedico";
        
        if ($doctorId !== null) {
            $sql .= " WHERE c.IdMedico = :doctorId";
        }
        
        $sql .= " ORDER BY c.FechaCita ASC";

        $stmt = $pdo->prepare($sql);
        
        if ($doctorId !== null) {
            $stmt->bindParam(':doctorId', $doctorId);
        }
        
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getTodayAppointments($doctorId) {
        global $pdo;

        $sql = "SELECT c.IdCita, p.NombreCompleto as PatientName, c.FechaCita, c.MotivoConsulta 
                FROM Citas c 
                INNER JOIN Pacientes p ON c.IdPaciente = p.IdPaciente 
                WHERE c.IdMedico = :doctorId 
                AND DATE(c.FechaCita) = CURDATE() 
                AND c.EstadoCita != 'cancelada'
                ORDER BY c.FechaCita ASC";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':doctorId', $doctorId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>