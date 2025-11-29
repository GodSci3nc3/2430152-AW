<?php
include '../../../config/connectDatabase.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $sql = "INSERT INTO Usuarios 
            (Usuario, CorreoElectronico, ContrasenaHash, Rol)
            VALUES 
            (:nombre, :correo, :contrasena, :rol)";

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rol = $_POST['rol'];
 
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':nombre', $username);
        $stmt->bindParam(':correo', $email);
        $stmt->bindParam(':contrasena', $password);
        $stmt->bindParam(':rol', $rol);
  

        $stmt->execute();
        header('Location: ../../../views/pages/doctor/patients.php?success=1');
        exit();
    } else {
        echo 'Método de petición incorrecto';
    }
?>