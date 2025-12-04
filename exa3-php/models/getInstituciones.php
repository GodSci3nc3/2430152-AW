<?php
require_once __DIR__ . '/../config.php';

function getInstituciones() {
    global $conn;

    $sql = "SELECT id, nombre FROM instituciones_bancarias WHERE activo = 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>