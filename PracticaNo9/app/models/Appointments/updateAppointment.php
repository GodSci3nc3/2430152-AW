<?php 
include '../../../config/connectDatabase.php';
require_once 'validateAppointment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $appointmentId = $_POST['IdCita'];
    $field = $_POST['field'];
    $value = $_POST['value'];
    
    // Manejar IdTarifa vacío como NULL
    if ($field == 'IdTarifa' && empty($value)) {
        $value = null;
    }

    if ($field == 'FechaCita') {
        $queryDoctor = "SELECT IdMedico FROM Citas WHERE IdCita = :appointmentId";
        $stmtDoctor = $pdo->prepare($queryDoctor);
        $stmtDoctor->bindParam(':appointmentId', $appointmentId);
        $stmtDoctor->execute();
        $appointment = $stmtDoctor->fetch(PDO::FETCH_ASSOC);
        
        if ($appointment) {
            $validation = validateAppointmentSchedule($pdo, $appointment['IdMedico'], $value, $appointmentId);
            
            if (!$validation['valid']) {
                echo json_encode([
                    'success' => false,
                    'message' => $validation['message']
                ]);
                exit;
            }
        }
    }

    if ($field == 'EstadoCita' && $value == 'completed') {
        $sqlCita = "SELECT c.IdPaciente, c.IdTarifa 
                    FROM Citas c
                    WHERE c.IdCita = :appointmentId";
        $stmtCita = $pdo->prepare($sqlCita);
        $stmtCita->bindParam(':appointmentId', $appointmentId);
        $stmtCita->execute();
        $cita = $stmtCita->fetch(PDO::FETCH_ASSOC);
        
        if ($cita) {
            $idTarifa = $cita['IdTarifa']; 
            $montoCita = 500.00; 
            $montoServicio = 0.00;
            
            if ($idTarifa) {
                $sqlTarifa = "SELECT CostoBase FROM Tarifas WHERE IdTarifa = :idTarifa AND Estatus = 1";
                $stmtTarifa = $pdo->prepare($sqlTarifa);
                $stmtTarifa->bindParam(':idTarifa', $idTarifa);
                $stmtTarifa->execute();
                $tarifa = $stmtTarifa->fetch(PDO::FETCH_ASSOC);
                
                if ($tarifa) {
                    $montoServicio = $tarifa['CostoBase'];
                }
            }
            
            $montoTotal = $montoCita + $montoServicio;
            
            $sqlCheckPago = "SELECT IdPago FROM Pagos WHERE IdCita = :appointmentId";
            $stmtCheck = $pdo->prepare($sqlCheckPago);
            $stmtCheck->bindParam(':appointmentId', $appointmentId);
            $stmtCheck->execute();
            $pagoExiste = $stmtCheck->fetch(PDO::FETCH_ASSOC);
            
            if (!$pagoExiste) {
                $sqlPago = "INSERT INTO Pagos (IdCita, IdPaciente, IdTarifa, Monto, MetodoPago, EstatusPago)
                            VALUES (:idCita, :idPaciente, :idTarifa, :monto, 'Pendiente', 'pendiente')";
                $stmtPago = $pdo->prepare($sqlPago);
                $stmtPago->bindParam(':idCita', $appointmentId);
                $stmtPago->bindParam(':idPaciente', $cita['IdPaciente']);
                $stmtPago->bindParam(':idTarifa', $idTarifa);
                $stmtPago->bindParam(':monto', $montoTotal);
                $stmtPago->execute();
            }
        }
    }

    $sql = "UPDATE Citas SET $field = :value WHERE IdCita = :appointmentId";
    $stmt = $pdo->prepare($sql);
    
    if ($value === null) {
        $stmt->bindValue(':value', null, PDO::PARAM_NULL);
    } else {
        $stmt->bindParam(':value', $value);
    }
    
    $stmt->bindParam(':appointmentId', $appointmentId);
    $stmt->execute();

    echo json_encode(['success' => true]);
}
?>
