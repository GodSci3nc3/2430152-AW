<?php 
    include '../../../config/connectDatabase.php';



    $idSpecialty = $_POST['idSpecialty'];

    $sql = "DELETE FROM Especialidades WHERE IdEspecialidad = :idspecialty";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':idspecialty', $idSpecialty);

    $stmt->execute();

    
?>