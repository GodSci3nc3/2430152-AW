<?php
include '../../../config/connectDatabase.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $idBitacora = $_POST['idBitacora'];
    $field = $_POST['field'];
    $value = $_POST['value'];
    
    // Verificar que el usuario es dueño de la bitácora
    $sqlCheck = "SELECT IdUsuario FROM Bitacora WHERE IdBitacora = :id";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->bindParam(':id', $idBitacora);
    $stmtCheck->execute();
    $bitacora = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    
    if ($bitacora && $bitacora['IdUsuario'] == $_SESSION['idUser']) {
        $sql = "UPDATE Bitacora SET $field = :value WHERE IdBitacora = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $idBitacora);
        $stmt->execute();
        
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No autorizado']);
    }
}
?>
