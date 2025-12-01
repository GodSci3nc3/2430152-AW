<?php 
include '../../../config/connectDatabase.php';

$recordId = $_POST['recordId'];
$column = $_POST['column'];
$change = $_POST['change'];

$sql = "UPDATE Expedientes SET $column = :change WHERE IdExpediente = :recordId";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':change', $change);
$stmt->bindParam(':recordId', $recordId);

$stmt->execute();
?>