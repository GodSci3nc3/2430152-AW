<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPago = $_POST['idPago'];
    $field = $_POST['field'];
    $value = $_POST['value'];
    
    try {
        $sql = "UPDATE Pagos SET $field = :value WHERE IdPago = :idPago";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':idPago', $idPago);
        $stmt->execute();
        
        echo json_encode([
            'success' => true,
            'message' => 'Pago actualizado correctamente'
        ]);
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error al actualizar pago: ' . $e->getMessage()
        ]);
    }
}
