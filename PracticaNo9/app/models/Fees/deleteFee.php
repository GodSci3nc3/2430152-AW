<?php 
    include '../../../config/connectDatabase.php';



    $idFee = $_POST['idFee'];

    $sql = "DELETE FROM Tarifas WHERE IdTarifa = :idFee ";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':idFee', $idFee);

    $stmt->execute();

    
?>