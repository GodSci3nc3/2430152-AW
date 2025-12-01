<?php 
include '../../../config/connectDatabase.php';

$appointmentId = $_POST['appointmentId'];

$sql = "DELETE FROM Citas WHERE IdCita = :appointmentId";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':appointmentId', $appointmentId);

$stmt->execute();
?>