<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

function getIngresosMensuales() {
    global $pdo;
    
    $sql = "SELECT 
                DATE_FORMAT(FechaPago, '%Y-%m') as mes,
                COALESCE(SUM(Monto), 0) as total
            FROM Pagos
            WHERE EstatusPago = 'Pagado'
            GROUP BY DATE_FORMAT(FechaPago, '%Y-%m')
            ORDER BY mes ASC
            LIMIT 12";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
