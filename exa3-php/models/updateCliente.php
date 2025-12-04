<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $rfc = $_POST['rfc'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $clabe = $_POST['clabe'];
    $id_institucion = $_POST['id_institucion'];
    $saldo_bancario = $_POST['saldo_bancario'];
    
    $sql = "UPDATE clientes SET 
            rfc = :rfc, 
            nombre = :nombre, 
            direccion = :direccion, 
            clabe = :clabe, 
            id_institucion = :id_institucion, 
            saldo_bancario = :saldo_bancario 
            WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':rfc', $rfc);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':clabe', $clabe);
    $stmt->bindParam(':id_institucion', $id_institucion);
    $stmt->bindParam(':saldo_bancario', $saldo_bancario);
    
    $stmt->execute();

    header('Location: ../index.php');
    exit();
}
?>