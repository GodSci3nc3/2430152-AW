<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    
    $sql = "UPDATE clientes SET activo = 0 WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: ../index.php');
    exit();
}
?>