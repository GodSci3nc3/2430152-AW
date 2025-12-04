<?php
include '../../../config/connectDatabase.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $sql = "INSERT INTO Pacientes 
            (NombreCompleto, CURP, FechaNacimiento, Sexo, Telefono, CorreoElectronico, Direccion, 
             ContactoEmergencia, TelefonoEmergencia, Alergias, AntecedentesMedicos, Estatus)
            VALUES 
            (:nombre, :curp, :fecha_nacimiento, :sexo, :telefono, :correo, :direccion,
             :contacto_emergencia, :telefono_emergencia, :alergias, :antecedentes, :estatus)";

        $nombre = "Sin nombre";
        $curp = "XXXX000000XXXXXXX0";
        $fecha_nacimiento = "2000-01-01";
        $sexo = "M";
        $telefono = "Sin teléfono";
        $correo = "sin-correo@ejemplo.com";
        $direccion = "Dirección desconocida";
        $contacto_emergencia = "Sin contacto";
        $telefono_emergencia = "Sin teléfono";
        $alergias = "Sin especificar";
        $antecedentes = "Sin especificar";
        $estatus = 1;

        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':curp', $curp);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':contacto_emergencia', $contacto_emergencia);
        $stmt->bindParam(':telefono_emergencia', $telefono_emergencia);
        $stmt->bindParam(':alergias', $alergias);
        $stmt->bindParam(':antecedentes', $antecedentes);
        $stmt->bindParam(':estatus', $estatus);

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
        header('Location: ../../../views/pages/doctor/patients.php?success=1');
        exit();
    } else {
        echo 'Método de petición incorrecto';
    }
?>