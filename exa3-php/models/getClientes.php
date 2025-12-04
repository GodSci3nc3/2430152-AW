<?php
require_once __DIR__ . '/../config.php';

function getClientes() {
    global $conn;

    $sql = "SELECT c.id, c.rfc, c.nombre, c.direccion, c.clabe, i.nombre AS institucion, c.saldo_bancario 
            FROM clientes c 
            INNER JOIN instituciones_bancarias i ON c.id_institucion = i.id 
            WHERE c.activo = 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>