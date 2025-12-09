<?php
    include '../../../config/connectDatabase.php';
    session_start();
    
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT IdUsuario, Usuario, ContrasenaHash, Rol, IdMedico 
                FROM Usuarios WHERE Usuario = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $response = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($response){
            if(password_verify($password, $response['ContrasenaHash'])){
                $_SESSION['idUser'] = $response['IdUsuario'];
                $_SESSION['username'] = $response['Usuario'];
                $_SESSION['rol'] = $response['Rol'];
                $_SESSION['idMedico'] = $response['IdMedico'];
                $_SESSION['permisoPacientes'] = 1;
                $_SESSION['permisoCitas'] = 1;
                $_SESSION['permisoExpedientes'] = 1;
                $_SESSION['permisoTarifas'] = 1;
                switch($response['Rol']) {
                    case 'admin': 
                        echo json_encode(['success' => true, 'redirect' => 'admin/dashboard_admin.php']);
                        break;
                    case 'doctor': 
                        echo json_encode(['success' => true, 'redirect' => 'doctor/dashboard_doctor.php']);
                        break;
                    case 'receptionist': 
                        echo json_encode(['success' => true, 'redirect' => 'receptionist/appointments.php']);
                        break;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'La contraseña ingresada es incorrecta']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Parece que ese usuario no existe. Comunícate con director de área para llevar registro de tu cuenta']);
            }
        ?>