<?php 
include '../../../config/connectDatabase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recordId = $_POST['recordId'];
    $column = $_POST['column'];
    $change = $_POST['change'];

    $sql = "UPDATE Expedientes SET $column = :change WHERE IdExpediente = :recordId";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':change', $change);
    $stmt->bindParam(':recordId', $recordId);

    $stmt->execute();
    
    echo json_encode(['success' => true]);
}
?>