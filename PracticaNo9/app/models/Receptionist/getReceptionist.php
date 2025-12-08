<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

function getReceptionistByDoctor($idMedico) {
    global $pdo;
    
    $sql = "SELECT IdUsuario, Usuario, CorreoElectronico, Activo 
            FROM Usuarios 
            WHERE IdMedicoAsignado = :idMedico AND Rol = 'receptionist'
            LIMIT 1";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idMedico', $idMedico);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
