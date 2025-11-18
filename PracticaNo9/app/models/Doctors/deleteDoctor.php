<?php 
    include '../../../config/connectDatabase.php';



    $idDoctor = $_POST['idDoctor'];

    $sql = "DELETE FROM Medicos WHERE IdMedico = :idDoctor ";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':idDoctor', $idDoctor);

    $stmt->execute();

    
?>