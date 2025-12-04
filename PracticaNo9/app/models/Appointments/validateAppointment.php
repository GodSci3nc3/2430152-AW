<?php

function validateAppointmentSchedule($pdo, $idMedico, $fechaCita, $idCitaExclude = null) {
    
    if (!$fechaCita) {
        return [
            'valid' => false,
            'message' => 'Fecha de cita inválida'
        ];
    }

    $dateObj = new DateTime($fechaCita);
    $appointmentDate = $dateObj->format('Y-m-d');
    $appointmentTime = $dateObj->format('H:i:s');
    $appointmentHour = (int)$dateObj->format('H');
    $appointmentMinute = (int)$dateObj->format('i');
    
    $queryDoctor = "SELECT HorarioAtencion FROM Medicos WHERE IdMedico = :idMedico";
    $stmtDoctor = $pdo->prepare($queryDoctor);
    $stmtDoctor->bindParam(':idMedico', $idMedico);
    $stmtDoctor->execute();
    $doctor = $stmtDoctor->fetch(PDO::FETCH_ASSOC);
    
    if (!$doctor) {
        return [
            'valid' => false,
            'message' => 'Médico no encontrado'
        ];
    }
    
    if ($doctor['HorarioAtencion']) {
        $schedule = explode(' - ', $doctor['HorarioAtencion']);
        if (count($schedule) == 2) {
            $startTime = explode(':', $schedule[0]);
            $endTime = explode(':', $schedule[1]);
            
            $startHour = (int)$startTime[0];
            $startMinute = isset($startTime[1]) ? (int)$startTime[1] : 0;
            $endHour = (int)$endTime[0];
            $endMinute = isset($endTime[1]) ? (int)$endTime[1] : 0;
            
            $appointmentMinutes = ($appointmentHour * 60) + $appointmentMinute;
            $startMinutes = ($startHour * 60) + $startMinute;
            $endMinutes = ($endHour * 60) + $endMinute;
            
            if ($appointmentMinutes < $startMinutes || $appointmentMinutes >= $endMinutes) {
                return [
                    'valid' => false,
                    'message' => 'La cita está fuera del horario de atención del médico (' . $doctor['HorarioAtencion'] . ')'
                ];
            }
        }
    }
    
    $queryConflict = "SELECT COUNT(*) as conflicts 
                      FROM Citas 
                      WHERE IdMedico = :idMedico 
                      AND DATE(FechaCita) = :appointmentDate
                      AND TIME(FechaCita) = :appointmentTime
                      AND EstadoCita != 'Cancelada'";
    
    if ($idCitaExclude) {
        $queryConflict .= " AND IdCita != :idCitaExclude";
    }
    
    $stmtConflict = $pdo->prepare($queryConflict);
    $stmtConflict->bindParam(':idMedico', $idMedico);
    $stmtConflict->bindParam(':appointmentDate', $appointmentDate);
    $stmtConflict->bindParam(':appointmentTime', $appointmentTime);
    
    if ($idCitaExclude) {
        $stmtConflict->bindParam(':idCitaExclude', $idCitaExclude);
    }
    
    $stmtConflict->execute();
    $result = $stmtConflict->fetch(PDO::FETCH_ASSOC);
    
    if ($result['conflicts'] > 0) {
        return [
            'valid' => false,
            'message' => 'El médico ya tiene una cita agendada a esa hora'
        ];
    }
    
    return [
        'valid' => true,
        'message' => 'Horario válido'
    ];
}

?>
