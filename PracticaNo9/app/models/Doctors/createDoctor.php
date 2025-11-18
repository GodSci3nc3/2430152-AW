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
        /* 
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':curp', $_POST['curp']);
        $stmt->bindParam(':fecha_nacimiento', $_POST['fecha_nacimiento']);
        $stmt->bindParam(':sexo', $_POST['sexo']);
        $stmt->bindParam(':telefono', $_POST['telefono']);
        $stmt->bindParam(':correo', $_POST['correo']);
        $stmt->bindParam(':direccion', $_POST['direccion']);
        $stmt->bindParam(':contacto_emergencia', $_POST['contacto_emergencia']);
        $stmt->bindParam(':telefono_emergencia', $_POST['telefono_emergencia']);
        $stmt->bindParam(':alergias', $_POST['alergias']);
        $stmt->bindParam(':antecedentes', $_POST['antecedentes']);
        */

        $stmt->execute();
        header('Location: ../../../views/pages/admin/doctors.php?success=1');
        exit();
    } else {
        echo 'Método de petición incorrecto';
    }
?>