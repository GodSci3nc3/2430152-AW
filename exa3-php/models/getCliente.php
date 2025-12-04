<?php
require_once __DIR__ . '/../config.php';

function getCliente($id) {
    global $conn;

    $sql = "SELECT * FROM clientes WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>