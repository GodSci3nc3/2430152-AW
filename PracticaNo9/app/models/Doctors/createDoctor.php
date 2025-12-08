<?php
include '../../../config/connectDatabase.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $sql = "INSERT INTO Medicos 
            (NombreCompleto, CedulaProfesional, EspecialidadId, Telefono, CorreoElectronico, HorarioAtencion, FechaIngreso)
            VALUES 
            (:nombrecompleto, :cedulaprofesional, :especialidadid, :telefono, :correoelectronico, :horarioatencion, :fechaingreso);";

        $nombreCompleto = "Doctor sin asignar";
        $cedulaProfesional = "SIN-CEDULA";
        $especialidadId = 1;  
        $telefono = "000-000-0000";
        $correoElectronico = "sin-correo@medicore.com";
        $horarioAtencion = "Sin definir";
        $fechaIngreso = date('Y-m-d H:i:s');

        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':nombrecompleto', $nombreCompleto);
        $stmt->bindParam(':cedulaprofesional', $cedulaProfesional);
        $stmt->bindParam(':especialidadid', $especialidadId);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correoelectronico', $correoElectronico);
        $stmt->bindParam(':horarioatencion', $horarioAtencion);
        $stmt->bindParam(':fechaingreso', $fechaIngreso);


        $stmt->execute();
        $idMedico = $pdo->lastInsertId();


        $sql = "INSERT INTO Usuarios 
            (Usuario, CorreoElectronico, ContrasenaHash, Rol, IdMedico)
            VALUES 
            (:nombre, :correo, :contrasena, :rol, :idmedico)";

 
        $stmt = $pdo->prepare($sql);

        $password = password_hash('123', PASSWORD_DEFAULT);
        $rol = 'doctor';


        $stmt->bindParam(':nombre', $nombreCompleto);
        $stmt->bindParam(':correo', $correoElectronico);
        $stmt->bindParam(':contrasena', $password);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':idmedico', $idMedico);
  

        $stmt->execute();
        
        // Crear recepcionista automáticamente
        $usuarioRecepcionista = 'recep_' . str_replace([' ', '.'], '_', strtolower($nombreCompleto));
        $passwordRecepcionista = bin2hex(random_bytes(8)); // Genera contraseña aleatoria de 16 caracteres
        $passwordRecepcionistaHash = password_hash($passwordRecepcionista, PASSWORD_DEFAULT);
        
        $sqlRecepcionista = "INSERT INTO Usuarios 
            (Usuario, ContrasenaHash, Rol, IdMedico, Activo)
            VALUES 
            (:usuario, :contrasena, 'receptionist', :idmedico, 1)";
        
        $stmtRecep = $pdo->prepare($sqlRecepcionista);
        $stmtRecep->bindParam(':usuario', $usuarioRecepcionista);
        $stmtRecep->bindParam(':contrasena', $passwordRecepcionistaHash);
        $stmtRecep->bindParam(':idmedico', $idMedico);
        $stmtRecep->execute();
        
        // Guardar la contraseña temporal en sesión para mostrarla al admin
        session_start();
        $_SESSION['temp_receptionist_password'] = $passwordRecepcionista;
        $_SESSION['temp_receptionist_user'] = $usuarioRecepcionista;
        
        header('Location: ../../../views/pages/admin/doctors.php?success=1');
        exit();
    } else {
        echo 'Método de petición incorrecto';
    }
?>