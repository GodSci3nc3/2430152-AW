<?php 
include '../../../config/connectDatabase.php';
require_once 'validateAppointment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $appointmentId = $_POST['IdCita'];
    $field = $_POST['field'];
    $value = $_POST['value'];

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

    // Si se marca como completada, crear el pago automáticamente
    if ($field == 'EstadoCita' && $value == 'completed') {
        // Obtener información de la cita incluyendo tarifa y especialidad
        $sqlCita = "SELECT c.IdPaciente, c.IdTarifa, m.EspecialidadId 
                    FROM Citas c
                    JOIN Medicos m ON c.IdMedico = m.IdMedico
                    WHERE c.IdCita = :appointmentId";
        $stmtCita = $pdo->prepare($sqlCita);
        $stmtCita->bindParam(':appointmentId', $appointmentId);
        $stmtCita->execute();
        $cita = $stmtCita->fetch(PDO::FETCH_ASSOC);
        
        if ($cita) {
            $idTarifa = null;
            $monto = 500.00; // Monto por defecto
            
            // Prioridad 1: Si la cita tiene una tarifa específica asignada
            if ($cita['IdTarifa']) {
                $sqlTarifaDirecta = "SELECT IdTarifa, CostoBase FROM Tarifas WHERE IdTarifa = :idTarifa AND Estatus = 1";
                $stmtTarifaDirecta = $pdo->prepare($sqlTarifaDirecta);
                $stmtTarifaDirecta->bindParam(':idTarifa', $cita['IdTarifa']);
                $stmtTarifaDirecta->execute();
                $tarifaDirecta = $stmtTarifaDirecta->fetch(PDO::FETCH_ASSOC);
                
                if ($tarifaDirecta) {
                    $idTarifa = $tarifaDirecta['IdTarifa'];
                    $monto = $tarifaDirecta['CostoBase'];
                }
            }
            
            // Prioridad 2: Si no, buscar tarifa por especialidad del médico
            if (!$idTarifa && $cita['EspecialidadId']) {
                $sqlTarifaEsp = "SELECT IdTarifa, CostoBase 
                                 FROM Tarifas 
                                 WHERE EspecialidadId = :especialidadId 
                                 AND Estatus = 1
                                 LIMIT 1";
                $stmtTarifaEsp = $pdo->prepare($sqlTarifaEsp);
                $stmtTarifaEsp->bindParam(':especialidadId', $cita['EspecialidadId']);
                $stmtTarifaEsp->execute();
                $tarifaEsp = $stmtTarifaEsp->fetch(PDO::FETCH_ASSOC);
                
                if ($tarifaEsp) {
                    $idTarifa = $tarifaEsp['IdTarifa'];
                    $monto = $tarifaEsp['CostoBase'];
                }
            }
            
            // Prioridad 3: Tarifa general (sin especialidad)
            if (!$idTarifa) {
                $sqlTarifaGen = "SELECT IdTarifa, CostoBase 
                                 FROM Tarifas 
                                 WHERE EspecialidadId IS NULL 
                                 AND Estatus = 1
                                 LIMIT 1";
                $stmtTarifaGen = $pdo->prepare($sqlTarifaGen);
                $stmtTarifaGen->execute();
                $tarifaGen = $stmtTarifaGen->fetch(PDO::FETCH_ASSOC);
                
                if ($tarifaGen) {
                    $idTarifa = $tarifaGen['IdTarifa'];
                    $monto = $tarifaGen['CostoBase'];
                }
            }
            
            // Verificar si ya existe un pago para esta cita
            $sqlCheckPago = "SELECT IdPago FROM Pagos WHERE IdCita = :appointmentId";
            $stmtCheck = $pdo->prepare($sqlCheckPago);
            $stmtCheck->bindParam(':appointmentId', $appointmentId);
            $stmtCheck->execute();
            $pagoExiste = $stmtCheck->fetch(PDO::FETCH_ASSOC);
            
            if (!$pagoExiste) {
                // Crear el pago
                $sqlPago = "INSERT INTO Pagos (IdCita, IdPaciente, IdTarifa, Monto, MetodoPago, EstatusPago)
                            VALUES (:idCita, :idPaciente, :idTarifa, :monto, 'Pendiente', 'pendiente')";
                $stmtPago = $pdo->prepare($sqlPago);
                $stmtPago->bindParam(':idCita', $appointmentId);
                $stmtPago->bindParam(':idPaciente', $cita['IdPaciente']);
                $stmtPago->bindParam(':idTarifa', $idTarifa);
                $stmtPago->bindParam(':monto', $monto);
                $stmtPago->execute();
            }
        }
    }

    $sql = "UPDATE Citas SET $field = :value WHERE IdCita = :appointmentId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':value', $value);
    $stmt->bindParam(':appointmentId', $appointmentId);
    $stmt->execute();

    echo json_encode(['success' => true]);
}
?>
