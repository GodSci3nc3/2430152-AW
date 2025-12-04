<?php
include '../../../config/connectDatabase.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $sql = "INSERT INTO Tarifas 
            (DescripcionServicio, CostoBase, EspecialidadId, Estatus)
            VALUES 
            (:descripcionservicio, :costobase, :especialidadid, :estatus)";

        $descripcionServicio = "Servicio sin descripción";
        $costoBase = "0.00";
        $especialidadid = 1;
        $estatus = 1;

        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':descripcionservicio', $descripcionServicio);
        $stmt->bindParam(':costobase', $costoBase);
        $stmt->bindParam(':especialidadid', $especialidadid);
        $stmt->bindParam(':estatus', $estatus);



        $stmt->execute();
        header('Location: ../../../views/pages/receptionist/fees_and_payments.php?success=1');
        exit();



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


    } else {
        echo 'Método de petición incorrecto';
    }
?>