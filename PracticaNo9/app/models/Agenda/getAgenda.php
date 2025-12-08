<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

function getAgendaByUser($userId) {
    global $pdo;
    
    $sql = "SELECT * FROM Bitacora 
            WHERE IdUsuario = :userId 
            ORDER BY FechaAcceso DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAgendaById($id) {
    global $pdo;
    
    $sql = "SELECT * FROM Bitacora WHERE IdBitacora = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
