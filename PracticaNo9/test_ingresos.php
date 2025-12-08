<?php
require_once 'config/connectDatabase.php';

echo "=== VERIFICANDO DATOS DE PAGOS ===\n\n";

// Ver algunos pagos de ejemplo
$stmt = $pdo->query('SELECT FechaPago, Monto, EstatusPago FROM Pagos LIMIT 10');
$pagos = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Ejemplos de pagos:\n";
print_r($pagos);

echo "\n\n=== INGRESOS MENSUALES ===\n";

// Consulta de ingresos mensuales
$stmt = $pdo->query("SELECT 
    DATE_FORMAT(FechaPago, '%Y-%m') as mes,
    COALESCE(SUM(Monto), 0) as total,
    COUNT(*) as cantidad
FROM Pagos
WHERE EstatusPago = 'Pagado'
GROUP BY DATE_FORMAT(FechaPago, '%Y-%m')
ORDER BY mes ASC");

$ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Ingresos mensuales:\n";
print_r($ingresos);

echo "\n\nJSON para JavaScript:\n";
echo json_encode($ingresos, JSON_PRETTY_PRINT);
?>
