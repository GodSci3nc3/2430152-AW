<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

function getTotalIngresos() {
    global $pdo;
    
    $sql = "SELECT COALESCE(SUM(Monto), 0) as total FROM Pagos WHERE EstatusPago = 'Pagado'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
?>
