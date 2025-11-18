<?php
    require_once __DIR__ . '/../../../config/connectDatabase.php';

    function getDoctors () {
    global $pdo;



        $sql = "SELECT m.IdMedico, m.NombreCompleto, e.NombreEspecialidad, m.Telefono, m.CorreoElectronico, m.HorarioAtencion FROM Medicos m INNER JOIN Especialidades e ON m.EspecialidadId = e.IdEspecialidad;";

        $stmt = $pdo->prepare($sql);
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
    

        return $stmt->fetchAll(PDO::FETCH_ASSOC);



    }

?>