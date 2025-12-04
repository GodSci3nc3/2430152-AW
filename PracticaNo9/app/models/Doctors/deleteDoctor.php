<?php 
    include '../../../config/connectDatabase.php';

  include '../../../config/connectDatabase.php';

    $idDoctor = $_POST['idDoctor'];

    /* Logic delete for doctors. This maintain the medic historial and audit records clean  */
    $sql = "UPDATE Medicos SET Estatus = 0 WHERE IdMedico = :idDoctor";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idDoctor', $idDoctor);
    $stmt->execute();


    $sql = "UPDATE Usuarios SET Activo = 0 WHERE IdMedico = :idDoctor";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idDoctor', $idDoctor);
    $stmt->execute();


?>