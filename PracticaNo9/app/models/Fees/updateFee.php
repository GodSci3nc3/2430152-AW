<?php
    require_once __DIR__ . '/../../../config/connectDatabase.php';

    global $pdo;
    $feeId = $_POST['idFee'];
    $column = $_POST['column'];
    $change = $_POST['change'];

    /* Never trust on frontend. All coming from user will validate in backend */
    $allowed_columns = ['DescripcionServicio', 'CostoBase'];

        if (!in_array($column, $allowed_columns)) {
            exit();
        }

        $sql = "UPDATE Tarifas SET $column = :change WHERE IdTarifa = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $feeId);
        $stmt->bindParam(':change', $change);
        $stmt->execute();


        /*
        
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
        */

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


?>