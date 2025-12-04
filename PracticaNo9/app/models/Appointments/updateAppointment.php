<?php 
include '../../../config/connectDatabase.php';

$appointmentId = $_POST['appointmentId'];
$column = $_POST['column'];
$change = $_POST['change'];

$sql = "UPDATE Citas SET $column = :change WHERE IdCita = :appointmentId";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':change', $change);
$stmt->bindParam(':appointmentId', $appointmentId);

$stmt->execute();
?>