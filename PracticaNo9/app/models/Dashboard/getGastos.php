<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

function getGastos($totalIngresos) {
    global $pdo;
    
    // Contar médicos activos
    $sql = "SELECT COUNT(*) as total FROM Medicos WHERE Estatus = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $numMedicos = $result['total'];
    
    // Gastos fijos: $15,000 por médico
    $gastosFijos = $numMedicos * 15000;
    
    // Gastos variables: 30% de los ingresos
    $gastosVariables = $totalIngresos * 0.30;
    
    // Total de gastos
    $gastosTotal = $gastosFijos + $gastosVariables;
    
    return [
        'total' => $gastosTotal,
        'fijos' => $gastosFijos,
        'variables' => $gastosVariables,
        'numMedicos' => $numMedicos
    ];
}
?>
