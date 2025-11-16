<?php 
    include '../../../config/connectDatabase.php';



    $idPaciente = $_POST['IdPaciente'];

    $sql = "DELETE FROM Pacientes WHERE IdPaciente = :idpaciente ";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':idpaciente', $idPaciente);

    $stmt->execute();

    
?>